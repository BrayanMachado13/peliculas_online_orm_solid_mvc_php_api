#ifndef HAVE_ZAI_SYMBOLS_API_LOCAL_H
#define HAVE_ZAI_SYMBOLS_API_LOCAL_H
// clang-format off
static inline zval *zai_symbol_lookup_local(
                        zai_symbol_scope_t scope_type, void *scope,
                        zai_str *name	) {
    return (zval *)zai_symbol_lookup(ZAI_SYMBOL_TYPE_LOCAL, scope_type, scope, name	);
}
// clang-format on
#endif
