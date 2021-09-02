<!-- Self-Hosted Video -->
<div class="me-video-container">
    <video class="video" muted autoplay loop src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>video/video.mp4"></video>
</div>

<div class="fs-me">

    <!-- Content Container -->
    <div class="me-content">

        <div class="logo">
            <span id="logo-text">M2M<br>Community</span><br>
        </div>

        <div class="bio">

            <p>... that they may be one as we are one. <a href="https://my.bible.com/bible/111/JHN.17.22" target="_blank" style="font-size:.5em;">John 17:22</a></p>
            <p><a href="/network/" class="btn" style="border: 1px solid white;padding: 20px;">Member Login</a></p>

        </div>

        <div class="network">

            <ul>

                <li>
                    <a class="icon-email" href="javascript:void(0)" onclick="jQuery('#modal').toggle()">
                        <svg class="svg-icon" viewBox="0 0 20 20">
                            <path d="M17.388,4.751H2.613c-0.213,0-0.389,0.175-0.389,0.389v9.72c0,0.216,0.175,0.389,0.389,0.389h14.775c0.214,0,0.389-0.173,0.389-0.389v-9.72C17.776,4.926,17.602,4.751,17.388,4.751 M16.448,5.53L10,11.984L3.552,5.53H16.448zM3.002,6.081l3.921,3.925l-3.921,3.925V6.081z M3.56,14.471l3.914-3.916l2.253,2.253c0.153,0.153,0.395,0.153,0.548,0l2.253-2.253l3.913,3.916H3.56z M16.999,13.931l-3.921-3.925l3.921-3.925V13.931z"></path>
                        </svg>
                    </a>
                </li>

            </ul>

        </div>

        <div id="modal">
            <div style="float:right; cursor:pointer;padding-right:10px;" onclick="jQuery('#modal').hide()">Close</div>
            <h1 class="display-1 display-1--light">Contact Us</h1>

            <form id="contact-form" action="">

                <div id="section-name" class="section">
                    <label for="name" class="input-label label-name">Name *
                        <input type="text" id="contact-name" name="name" class="input-text input-name" value="" required="required" ></label>
                    <span id="contact-name-error" class="form-error">You're name is required.</span>
                </div>

                <div id="section-email" class="section">
                    <label for="email" class="input-label label-email">Email *
                        <input type="email" id="contact-email" name="email" class="input-text input-email" value="" >
                        <input type="email" id="contact-e2" name="email2" class="input-text email" value="" required="required" >
                    </label>
                    <span id="contact-email-error" class="form-error">You're email is required.</span>
                </div>

                <div id="section-phone" class="section">
                    <label for="phone" class="input-label">Phone *
                        <input type="tel" id="contact-phone" name="phone" class="input-text input-phone" value="" required="required" ></label>
                    <span id="contact-phone-error" class="form-error">You're phone is required.</span>
                </div>

                <div id="section-permission" class="section">
                    <label for="phone" class="input-label">Comment
                        <textarea id="contact-comment" name="comment" class="input-text" value=""></textarea>
                    </label>
                </div>

                <div class="section" id="submit-button-container">
                    <span style="color:red" class="form-submit-error"></span>
                    <button type="button" class="submit-button ignore" id="submit-button-contact" disabled>Submit</button> <span class="loading-spinner"></span>
                </div>

            </form>

        </div>

        <div class="credit">

            <p class="copyright">All copyrights reserved &copy;  <script>document.write(new Date().getFullYear())</script></p>

        </div>

    </div>

</div>
<script>
    jQuery(document).ready(function(){
        // This is a form delay to discourage robots
        let counter = 5;
        let myInterval = setInterval(function () {
            let button = jQuery('.submit-button')

            button.html( 'Available in ' + counter)
            --counter;

            if ( counter === 0 ) {
                clearInterval(myInterval);
                button.html( 'Submit' ).prop('disabled', false)
            }

        }, 1000);

        /* NEWSLETTER */
        let submit_button_newsletter = jQuery('#submit-button-newsletter')
        submit_button_newsletter.on('click', function(){
            let spinner = jQuery('.loading-spinner')
            spinner.addClass('active')
            submit_button_newsletter.prop('disabled', true)

            let honey = jQuery('#email').val()
            if ( honey ) {
                submit_button_newsletter.html('Shame, shame, shame. We know your name ... ROBOT!').prop('disabled', true )
                spinner.removeClass('active')
                return;
            }

            let fname_input = jQuery('#newsletter-fname')
            let fname = fname_input.val()
            if ( ! fname ) {
                jQuery('#name-error').show()
                submit_button_newsletter.removeClass('loading')
                fname_input.focus(function(){
                    jQuery('#name-error').hide()
                })
                submit_button_newsletter.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let lname_input = jQuery('#newsletter-lname')
            let lname = fname_input.val()
            if ( ! fname ) {
                jQuery('#name-error').show()
                submit_button_newsletter.removeClass('loading')
                lname_input.focus(function(){
                    jQuery('#name-error').hide()
                })
                submit_button_newsletter.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let email_input = jQuery('#newsletter-e2')
            let email = email_input.val()
            if ( ! email ) {
                jQuery('#email-error').show()
                submit_button_newsletter.removeClass('loading')
                email_input.focus(function(){
                    jQuery('#email-error').hide()
                })
                submit_button_newsletter.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let form_data = {
                fname: fname,
                lname: lname,
                email: email,
                permission: permission
            }

            jQuery.ajax({
                type: "POST",
                data: JSON.stringify({ action: 'newsletter', parts: jsObject.parts, data: form_data }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
                }
            })
                .done(function(response){
                    jQuery('.loading-spinner').removeClass('active')
                    console.log(response)

                })
                .fail(function(e) {
                    console.log(e)
                    jQuery('#error').html(e)
                })
        })

        /* CONTACT FORM */
        let submit_button_contact = jQuery('#submit-button-contact')
        submit_button_contact.on('click', function(){
            let spinner = jQuery('.loading-spinner')
            spinner.addClass('active')
            submit_button_contact.prop('disabled', true)

            let honey = jQuery('#contact-email').val()
            if ( honey ) {
                submit_button_contact.html('Shame, shame, shame. We know your name ... ROBOT!').prop('disabled', true )
                spinner.removeClass('active')
                return;
            }

            let name_input = jQuery('#contact-name')
            let name = name_input.val()
            if ( ! name ) {
                jQuery('#name-error').show()
                submit_button_contact.removeClass('loading')
                name_input.focus(function(){
                    jQuery('#name-error').hide()
                })
                submit_button_contact.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let email_input = jQuery('#contact-e2')
            let email = email_input.val()
            if ( ! email ) {
                jQuery('#email-error').show()
                submit_button_contact.removeClass('loading')
                email_input.focus(function(){
                    jQuery('#email-error').hide()
                })
                submit_button_contact.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let phone_input = jQuery('#contact-phone')
            let phone = phone_input.val()
            if ( ! phone ) {
                jQuery('#phone-error').show()
                submit_button_contact.removeClass('loading')
                email_input.focus(function(){
                    jQuery('#phone-error').hide()
                })
                submit_button_contact.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let comment = jQuery('#contact-comment').html()

            let form_data = {
                name: name,
                email: email,
                phone: phone,
                comment: comment
            }

            jQuery.ajax({
                type: "POST",
                data: JSON.stringify({ action: 'followup', parts: jsObject.parts, data: form_data }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
                }
            })
                .done(function(response){
                    jQuery('.loading-spinner').removeClass('active')
                    console.log(response)

                })
                .fail(function(e) {
                    console.log(e)
                    jQuery('#error').html(e)
                })
        })

    })
</script>
<style>
    #contact-email {display:none;}
    .form-error {
        display:none;
    }
    .input-label {
        font-family: sans-serif;
        font-size: 1.4rem;
        font-weight: normal;
        display: block;
    }



    input.input-text {
        display: block;
        padding: .5rem;
        background-color: white;
        color: #151515;
        font-family: metropolis-semibold, sans-serif;
        font-size: 1.5rem;
        line-height: 3rem;
        width: 50% !important;
        max-width: 100%;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    textarea.input-text {
        display: block;
        padding: .5rem;
        background-color: white;
        border:2px solid black;
        outline: none;
        color: #151515;
        font-family: metropolis-semibold, sans-serif;
        font-size: 1.5rem;
        line-height: 3rem;
        width: 50% !important;
        max-width: 100%;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }


    /*body {*/
    /*    background-color: rgb(17, 17, 17) !important;*/
    /*}*/

    .form-error {
        color: red;
    }

    /*!* begin spinner *!*/
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    .loading-spinner.active {
        border-radius: 50%;
        width: 24px;
        height: 24px;
        border: 0.25rem solid #919191;
        border-top-color: black;
        animation: spin 1s infinite linear;
        display: inline-block;
    }
    /* end spinner */

    .submit-button {
        padding: 1rem;
        font-size: 1.5rem;
    }

    /*.section {*/
    /*    padding-top: 10px;*/
    /*}*/
</style>
