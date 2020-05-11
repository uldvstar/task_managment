export default {
    actions: {
        createNotification(store, payload){
            let content = '<div class="row"><div class="col"> <div class="row"> <div class="col all-caps fs-13 bold">'+payload.title+'</div> </div> <div class="row fs-12 m-t-5"> <div class="col">'+payload.message+'</div> </div> </div> </div>';
            new Noty({
                type: payload.type,
                text: content,
                timeout: 5000,
                closeWith: ['button'],
                layout: "bottomRight",
                theme: "metroui"
            }).show();
        }
    }
}