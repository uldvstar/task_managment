export default {
    methods: {
        submit(url, method, section, successNotification = true, errorNotification = true){
            if(!this.validate()){ return; }
            if(section){ this.$store.dispatch('toggleLoading', {name: section, status: true}) };
            this.$store.dispatch('crudRequest', {
                endpoint: url,
                method: method,
                parameters: this.parameters
            }).then(response => {
                let success = response.ok,
                    statusCode = response.status;
                response.json().then(response => {

                    if(!success){

                        if(statusCode === 401){
                            window.location.href = route('authenticate.expire');
                        }

                        errorNotification ? this.$store.dispatch('createNotification', {title: response.title, message: response.message, type: 'error'}): null;
                        this.errorHandler(response); return;
                    }

                    successNotification ? this.$store.dispatch('createNotification', {title: response.title, message: response.message, type: 'success'}): null;
                    this.successHandler(response)


                });
            }).catch((error) => {
                this.$store.dispatch('createNotification', {title: 'Unexpected Error', message: 'An unexpected error has occurred. Try again!', type: 'error'});
            }).then(() => {
                if(section){ this.$store.dispatch('toggleLoading', {name: section, status: false}) };
            })

        },
        validate() {
            if(this.$v){
                this.$v.$touch();
                return !this.$v.$invalid;
            }
            return true;
        },
        successHandler(response){},
        errorHandler(response){}
    }

}