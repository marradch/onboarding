1. composer install
2. run migrations
3. run seeds

4. Для работы с апи используеться sanctum

4.1 

в env указать настройки, где localhost - домен приложения

SESSION_DOMAIN=localhost
SANCTUM_STATEFUL_DOMAINS=localhost

4.2 тестирование

перед запросами в postman (standalone)
настройка pre-request script

pm.sendRequest({
    url: 'http://test.onboarding.local/sanctum/csrf-cookie',
    method: 'GET'
}, function (error, response, { cookies }) {
    if (!error) {
        pm.environment.set('xsrf-token', cookies.get('XSRF-TOKEN'))
    }
})

хидер
X-XSRF-TOKEN
значение
{{xsrf-token}}

он сам подставит токен