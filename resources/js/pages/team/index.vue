<template>
    <div>
        <div id="header" class="row">
            <div class="col">
                <h5>Team</h5>
            </div>
            <div class="col">
                <router-link class="float-right" :to="{name: 'create.team'}" tag="button">Create</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col">               
                <card>
                    <h6>Favanzi</h6>
                </card>
            </div>
        </div>
    </div>
</template>

<style>
    #header {
        margin-top: 12px;
    }

    h5 {
        color: white;
    }
</style>