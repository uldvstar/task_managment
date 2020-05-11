export default {
    actions: {
        crudRequest({getters},  {endpoint, method, parameters}){
            return fetch(endpoint, {
                method: method,
                responseType: 'json',
                body: parameters ? JSON.stringify(parameters):null,
                headers: {
                    'content-type': 'application/json',
                    'Authorization': 'Bearer '+getters.getAccessToken
                }
            }).then(response => {
                return response;
            })
        }
    }
}