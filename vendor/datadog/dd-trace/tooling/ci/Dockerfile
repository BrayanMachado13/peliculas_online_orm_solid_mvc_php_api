FROM datadog/dd-appsec-php-ci:php-7.0-release AS php_agent_debug
RUN apt-get update && apt-get install -y jq
COPY ./tooling/ci/ddtrace-info.sh ./tooling/ci/binaries* /binaries/
RUN /binaries/ddtrace-info.sh
RUN php -d error_reporting='' -r 'echo phpversion("ddtrace");' > /binaries/LIBRARY_VERSION
RUN touch -c -a -m -d @0 /binaries/*

FROM scratch as collect
COPY --from=php_agent_debug /binaries/dd-library-php-*-gnu.tar.gz /
COPY --from=php_agent_debug /binaries/datadog-setup.php /datadog-setup.php
COPY --from=php_agent_debug /binaries/LIBRARY_VERSION /LIBRARY_VERSION

FROM scratch
COPY --from=collect /* /