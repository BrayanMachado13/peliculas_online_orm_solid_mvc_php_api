#ifndef DOGSTATSD_CLIENT_H
#define DOGSTATSD_CLIENT_H

#include <netdb.h>
#include <stdbool.h>
#include <stddef.h>
#include <sys/un.h>

/* This describes a simple interface to communicate with dogstatsd. It only
 * implements the portions of the interface that the PHP tracer needs. If it
 * gets enough features and there is interest from another project, we could
 * pull it out and release it as its own project.
 */

#if __cplusplus
extern "C" {
#endif

struct dogstatsd_client {
  int socket;                    // closed on dtor
  struct addrinfo *address;      // freed on dtor as part of addresslist
  struct addrinfo *addresslist;  // freed on dtor
  char *msg_buffer;              // NOT freed on dtor
  int msg_buffer_len;
  const char *const_tags;  // NOT freed on dtor
  size_t const_tags_len;
};
typedef struct dogstatsd_client dogstatsd_client;

enum dogstatsd_client_status {
  // This doesn't mean delivered; just that nothing went visibly wrong.
  DOGSTATSD_CLIENT_OK = 0,

  // errors:
  DOGSTATSD_CLIENT_E_NO_CLIENT,
  DOGSTATSD_CLIENT_E_VALUE,
  DOGSTATSD_CLIENT_E_TOO_LONG,
  DOGSTATSD_CLIENT_E_FORMATTING,
  DOGSTATSD_CLIENT_EWRITE,
};
typedef enum dogstatsd_client_status dogstatsd_client_status;

inline const char *dogstatsd_client_status_to_str(
    dogstatsd_client_status status) {
  switch (status) {
    case DOGSTATSD_CLIENT_OK:
      return "OK";
    case DOGSTATSD_CLIENT_E_NO_CLIENT:
      return "E_NO_CLIENT";
    case DOGSTATSD_CLIENT_E_VALUE:
      return "E_VALUE";
    case DOGSTATSD_CLIENT_E_TOO_LONG:
      return "E_TOO_LONG";
    case DOGSTATSD_CLIENT_E_FORMATTING:
      return "E_FORMATTING";
    case DOGSTATSD_CLIENT_EWRITE:
      return "E_WRITE";
    default:
      return NULL;
  }
}

/* A typical IPv4 header is 20 bytes, but can be up to 60 bytes.
 * The UDP header is 8 bytes.
 * The minimum maximum reassembly buffer size required by RFC 1122 is 576.
 * 576 - 60 - 8 = 508.
 *
 * If we consider IPv6, the situation is different. IPv6 packets cannot be
 * fragmented, and the minimum MTU is 1280. Most implementations seem to use
 * 1024 for the IPv6 buffer.
 *
 * Ethernet has an MTU 1500.
 *
 * The official Java dogstatsd client uses 1400. Given this, I am presuming
 * that most hardware in use today is capable of supporting IPv6, and out of
 * implementation simplicity they support the IPv6 sizes on IPv4 too, and
 * chose the IPv6 numbers.
 */
#define DOGSTATSD_CLIENT_RECOMMENDED_MAX_MESSAGE_SIZE 1024

enum dogstatsd_metric_t {
  DOGSTATSD_METRIC_COUNT,
  DOGSTATSD_METRIC_GAUGE,
  DOGSTATSD_METRIC_HISTOGRAM,
};
typedef enum dogstatsd_metric_t dogstatsd_metric_t;

// Returns NULL on bad enum values
inline const char *dogstatsd_metric_type_to_str(dogstatsd_metric_t type) {
  switch (type) {
    case DOGSTATSD_METRIC_COUNT:
      return "c";
    case DOGSTATSD_METRIC_GAUGE:
      return "g";
    case DOGSTATSD_METRIC_HISTOGRAM:
      return "h";
    default:
      return NULL;
  }
}

// Creates a client whose operations will fail with E_NO_CLIENT
inline dogstatsd_client dogstatsd_client_default_ctor() {
  dogstatsd_client client = {-1, NULL, NULL, NULL, 0, NULL, 0};
  return client;
}

inline bool dogstatsd_client_is_default_client(dogstatsd_client client) {
  return client.socket == -1;
}

void dogstatsd_client_dtor(dogstatsd_client *client);

/* Wrapper around getaddrinfo to connect using UDP.
 * Returns the result of getaddrinfo.
 */
int dogstatsd_client_getaddrinfo(struct addrinfo **result, const char *host,
                                 const char *port);

/* If the client fails to open a socket, it will create a default client. */
dogstatsd_client dogstatsd_client_ctor(struct addrinfo *addrs, int buffer_len,
                                       const char *const_tags);

/* Most generic way to send a metric. If the input is malformed the metric will
 * not be sent, and an error code will be returned.
 * The sample_rate must be between 0.0 and 1.0 inclusive.
 */
dogstatsd_client_status dogstatsd_client_metric_send(
    dogstatsd_client *client, const char *metric, const char *value,
    dogstatsd_metric_t type, double sample_rate, const char *tags);

inline dogstatsd_client_status dogstatsd_client_count(dogstatsd_client *client,
                                                      const char *metric,
                                                      const char *value,
                                                      const char *tags) {
  dogstatsd_metric_t type = DOGSTATSD_METRIC_COUNT;
  return dogstatsd_client_metric_send(client, metric, value, type, 1.0, tags);
}

inline dogstatsd_client_status dogstatsd_client_gauge(dogstatsd_client *client,
                                                      const char *metric,
                                                      const char *value,
                                                      const char *tags) {
  dogstatsd_metric_t type = DOGSTATSD_METRIC_GAUGE;
  return dogstatsd_client_metric_send(client, metric, value, type, 1.0, tags);
}

inline dogstatsd_client_status dogstatsd_client_histogram(
    dogstatsd_client *client, const char *metric, const char *value,
    const char *tags) {
  dogstatsd_metric_t type = DOGSTATSD_METRIC_HISTOGRAM;
  return dogstatsd_client_metric_send(client, metric, value, type, 1.0, tags);
}

#if __cplusplus
}
#endif

#endif  // DOGSTATSD_CLIENT_H
