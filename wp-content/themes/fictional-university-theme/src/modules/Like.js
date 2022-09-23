import $, { post } from "jquery"

class Like {
    constructor() {
        this.events();
    }

    events() {
        // Lo que ocurre es que a la clase cuando ocurre el evento 'click' va a ocurrir la siguiente función. 
        $(".like-box").on('click', this.ourClickDispatcher.bind(this));
    }

    // methods: 
    ourClickDispatcher(e) {
        // para que si clickea en el corazón tome el evento de todos los ancestros cercanos. 
        var currentLikBox = $(e.target).closest(".like-box");
        // Aquí se enviarán las requests para add a like or delete a like. 
        if(currentLikBox.data('exists') == 'yes') {
            this.deleteLike(currentLikBox);
        } else {
            this.createLike(currentLikBox);
        }
    };

    createLike(currentLikBox) {
        $.ajax({
            beforeSend: xhr => {
                xhr.setRequestHeader("X-WP-Nonce", universityData.nonce)
            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'POST',
            data: {'professorId': currentLikBox.data('professor')},
            success: (response) => {
                currentLikBox.attr('data-exists', 'yes');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    };

    deleteLike() {
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'DELETE',
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
}

export default Like;