<template>
	<div class="loginer">
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-linear-official-50 border border-white">
            <div class="modal-header tit-up">
                <div class="w-100 d-flex justify-content-between pr-3">
                    <button type="button" class="close mt-2 mr-2 text-white-50" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Formulaire d'inscription</h4>
                </div>
            </div>
            <div class="modal-body customer-box">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs bg-transparent">
                    <li><a class="active" href="#Login" data-toggle="tab">Se connecter</a></li>
                    <li><a href="#Registration" data-toggle="tab">S'inscrire</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <loginer></loginer>
                    <registration></registration>
                </div>
            </div>
        </div>
      </div>
    </div>

	</div>
</template>

<style>
    .loginer input.form-control{
        
    }

    .customer-box .tab-content .form-group .form-control, .loginer select{
        height: 40px !important;
        padding: 3px !important;
        font-size: 1.1rem !important;
        margin: 0 !important;
        color: black !important;
    }
</style>