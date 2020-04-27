<template>
    <div id="container">
        <div id="jumbotron" class="jumbotron p-0 mb-0">
            <!-- Card image -->
            <div class="view overlay text-center">
                <img src="storage/emailconfirmationhint.svg" id="illustrator" class="img-fluid" alt="Email Confirmation Hint Illustration">
            </div>

            <!-- Card content -->
            <div class="card-title mb-0">

                <!-- Title -->
                <h3 class="card-title h3 my-4 text-white text-center"><strong>Thank You!</strong></h3>
                <!-- Text -->
                <p class="card-text text-white text-justify my-4">We will send you a confirmation e-mail shortly with an activation link to get you started with kitajoin.</p>
                <!-- Button -->
                <router-link :to="{ name: 'login' }" id="gotologin" class="btn btn-secondary btn-block btn-lg mb-4">
                    GO TO LOG IN
                </router-link>
                <!-- Text -->
                <div class="text-center text-white">
                    <p class="mb-0">Didn't see it?</p>
                    <p class="mb-0">Check your spam for an e-mail from <span class="text-secondary font-weight-bold">KITAJOIN</span></p>
                    <p class="mb-0">or <span class="text-secondary font-weight-bold">send again</span></p>
                </div>
                
            </div>
        </div>
    </div>
</template>

<style scoped>
    #jumbotron {
        background-color: black;
    }

    #illustrator {
        width: 188px;
    }

    #container {
        padding: 86px 27px;
    }

    #gotologin {
        border-radius: 4px;
        font-size: 1rem;
    }

    .card-title p {
        font-size: 0.75rem
    }
</style>