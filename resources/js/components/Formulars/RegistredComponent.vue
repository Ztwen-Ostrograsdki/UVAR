<template>
	<div class="loginer">
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-linear-official-50 border border-white">
            <div class="modal-header tit-up">
                <div class="w-100 d-flex justify-content-between pr-3">
                    <button type="button" class="close mt-2 mr-2 text-white-50" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Formulaire de membre</h4>
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
                    <div class="tab-pane active" id="Login">
                        <form role="form" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control is-invalid" id="login_email" placeholder="login_email" type="text">
                                    <i class="invalid-feedback m-0 p-0 mt-1">L'addresse ne correspond pas</i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control is-invalid" name="login_pwd" id="login_pwd" placeholder="mot de passe" type="password">
                                    <i class="invalid-feedback m-0 p-0 mt-1">Le mot de passe ne correspond pas</i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <button type="submit" data-dismiss="modal" data-toggle="modal" data-target="#successConnected" class=" ml-3 btn w-25 btn-radius btn-primary btn-radius px-3 py-2 border border-white">
                                        Se connecter
                                    </button>
                                    <a class="for-pwd" href="javascript:;">Mot de passe oublier?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="Registration">
                        <form role="form" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control is-invalid" name="name" id="name" placeholder="Votre nom et prenoms" type="text">
                                    <i class="invalid-feedback m-0 p-0 mt-1">L'addresse ne correspond pas</i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control is-invalid" name="email" id="email" placeholder="Votre addresse email" type="email">
                                    <i class="invalid-feedback m-0 p-0 mt-1">L'addresse ne correspond pas</i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 d-flex justify-content-between">
                                    <div class="" style="width: 60%">
                                        <input class="form-control" name="mobile" id="mobile" placeholder="Vos contacts" type="text">
                                        <i class="invalid-feedback m-0 p-0 mt-1">L'addresse ne correspond pas</i>

                                    </div>
                                    <div style="width: 38%">
                                        <select class="custom-select py-3">
                                            <option>Benin</option>
                                            <option>Benin</option>
                                            <option>Benin</option>
                                            <option>Benin</option>
                                            <option>Benin</option>
                                            <option>Benin</option>
                                        </select>
                                        <i class="invalid-feedback m-0 p-0 mt-1">L'addresse ne correspond pas</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control" id="password" name="password" placeholder="Votre mot de passe" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot de passe" type="password">
                                </div>
                            </div>
                            <div class="row">                           
                                <div class="col-sm-10">
                                    <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#confirmationRegistration" class="btn btn-primary border border-white py-2 px-3 btn-radius w-25">
                                        Soumettre
                                    </button>
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary btn-radius py-2 px-3 border border-dark w-25">
                                        Annuler</button>
                                </div>
                            </div>
                        </form>
                    </div>
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