<template>
	<div class="editMemberData">
	<div class="modal fade" id="editMemberData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-linear-official-50 border border-white">
            <div class="modal-header tit-up">
                <div class="w-100 d-flex justify-content-between pr-3">
                    <button type="button" class="close mt-2 mr-2 text-white-50" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 v-if="connected && active_member && active_member.id !== null" class="modal-title text-white">Edition de profil de {{active_member.name}}</h4>
                </div>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input autocomplete="name"  class="form-control" :class="invalidsEditMember.name !== undefined ? 'is-invalid' : '' " v-model="editingMember.name" name="name" placeholder="Votre nom et prenoms" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsEditMember.name !== undefined">{{ invalidsEditMember.name[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input autocomplete="phone"  class="form-control" :class="invalidsEditMember.phone !== undefined ? 'is-invalid' : '' " v-model="editingMember.phone" name="phone
                            " placeholder="Votre contact" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsEditMember.phone !== undefined">{{ invalidsEditMember.phone[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select :class="invalidsEditMember.country !== undefined ? 'is-invalid' : '' " v-model="editingMember.country" autocomplete="country" name="country" class="form-control custom-select">
                                <option :value="c" v-for="c in countries">
                                    {{c}}
                                </option>
                            </select>
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsEditMember.country !== undefined">{{ invalidsEditMember.country[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select :class="invalidsEditMember.sexe !== undefined ? 'is-invalid' : '' " v-model="editingMember.sexe" autocomplete="sexe" name="sexe" class="form-control custom-select">
                                <option :value="'male'">Masculin</option>
                                <option :value="'female'">Féminin</option>
                            </select>
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsEditMember.sexe !== undefined">{{ invalidsEditMember.sexe[0] }}</i>
                        </div>
                    </div>
                    
                    
                    <div class="row px-3">                           
                        <div class="col-sm-9">
                            <button type="button"class="btn btn-primary border border-white py-2 px-3 btn-radius w-25" @click="updateMemberData()">
                                Mettre à jour
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
</template>
<script>
    import { mapState } from 'vuex'
    export default {
        data() {
            return {
                countries :
                { "AF": "Afghanistan", "ZA": "Afrique du Sud", "AL": "Albanie", "DZ": "Algérie", "DE": "Allemagne", "AD": "Andorre", "AO": "Angola", "AI": "Anguilla", "AQ": "Antarctique", "AG": "Antigua-et-Barbuda", "AN": "Antilles néerlandaises", "SA": "Arabie saoudite", "AR": "Argentine", "AM": "Arménie", "AW": "Aruba", "AU": "Australie", "AT": "Autriche", "AZ": "Azerbaïdjan", "BS": "Bahamas", "BH": "Bahreïn", "BD": "Bangladesh", "BB": "Barbade", "BY": "Bélarus", "BE": "Belgique", "BZ": "Belize", "BJ": "Bénin", "BM": "Bermudes", "BT": "Bhoutan", "BO": "Bolivie", "BA": "Bosnie-Herzégovine", "BW": "Botswana", "BR": "Brésil", "BN": "Brunéi Darussalam", "BG": "Bulgarie", "BF": "Burkina Faso", "BI": "Burundi", "KH": "Cambodge", "CM": "Cameroun", "CA": "Canada", "CV": "Cap-Vert", "EA": "Ceuta et Melilla", "CL": "Chili", "CN": "Chine", "CY": "Chypre", "CO": "Colombie", "KM": "Comores", "CG": "Congo-Brazzaville", "KP": "Corée du Nord", "KR": "Corée du Sud", "CR": "Costa Rica", "CI": "Côte d’Ivoire", "HR": "Croatie", "CU": "Cuba", "DK": "Danemark", "DG": "Diego Garcia", "DJ": "Djibouti", "DM": "Dominique", "EG": "Égypte", "SV": "El Salvador", "AE": "Émirats arabes unis", "EC": "Équateur", "ER": "Érythrée", "ES": "Espagne", "EE": "Estonie", "VA": "État de la Cité du Vatican", "FM": "États fédérés de Micronésie", "US": "États-Unis", "ET": "Éthiopie", "FJ": "Fidji", "FI": "Finlande", "FR": "France", "GA": "Gabon", "GM": "Gambie", "GE": "Géorgie", "GS": "Géorgie du Sud et les îles Sandwich du Sud", "GH": "Ghana", "GI": "Gibraltar", "GR": "Grèce", "GD": "Grenade", "GL": "Groenland", "GP": "Guadeloupe", "GU": "Guam", "GT": "Guatemala", "GG": "Guernesey", "GN": "Guinée", "GQ": "Guinée équatoriale", "GW": "Guinée-Bissau", "GY": "Guyana", "GF": "Guyane française", "HT": "Haïti", "HN": "Honduras", "HU": "Hongrie", "BV": "Île Bouvet", "CX": "Île Christmas", "CP": "Île Clipperton", "AC": "Île de l'Ascension", "IM": "Île de Man", "NF": "Île Norfolk", "AX": "Îles Åland", "KY": "Îles Caïmans", "IC": "Îles Canaries", "CC": "Îles Cocos - Keeling", "CK": "Îles Cook", "FO": "Îles Féroé", "HM": "Îles Heard et MacDonald", "FK": "Îles Malouines", "MP": "Îles Mariannes du Nord", "MH": "Îles Marshall", "UM": "Îles Mineures Éloignées des États-Unis", "SB": "Îles Salomon", "TC": "Îles Turks et Caïques", "VG": "Îles Vierges britanniques", "VI": "Îles Vierges des États-Unis", "IN": "Inde", "ID": "Indonésie", "IQ": "Irak", "IR": "Iran", "IE": "Irlande", "IS": "Islande", "IL": "Israël", "IT": "Italie", "JM": "Jamaïque", "JP": "Japon", "JE": "Jersey", "JO": "Jordanie", "KZ": "Kazakhstan", "KE": "Kenya", "KG": "Kirghizistan", "KI": "Kiribati", "KW": "Koweït", "LA": "Laos", "LS": "Lesotho", "LV": "Lettonie", "LB": "Liban", "LR": "Libéria", "LY": "Libye", "LI": "Liechtenstein", "LT": "Lituanie", "LU": "Luxembourg", "MK": "Macédoine", "MG": "Madagascar", "MY": "Malaisie", "MW": "Malawi", "MV": "Maldives", "ML": "Mali", "MT": "Malte", "MA": "Maroc", "MQ": "Martinique", "MU": "Maurice", "MR": "Mauritanie", "YT": "Mayotte", "MX": "Mexique", "MD": "Moldavie", "MC": "Monaco", "MN": "Mongolie", "ME": "Monténégro", "MS": "Montserrat", "MZ": "Mozambique", "MM": "Myanmar", "NA": "Namibie", "NR": "Nauru", "NP": "Népal", "NI": "Nicaragua", "NE": "Niger", "NG": "Nigéria", "NU": "Niue", "NO": "Norvège", "NC": "Nouvelle-Calédonie", "NZ": "Nouvelle-Zélande", "OM": "Oman", "UG": "Ouganda", "UZ": "Ouzbékistan", "PK": "Pakistan", "PW": "Palaos", "PA": "Panama", "PG": "Papouasie-Nouvelle-Guinée", "PY": "Paraguay", "NL": "Pays-Bas", "PE": "Pérou", "PH": "Philippines", "PN": "Pitcairn", "PL": "Pologne", "PF": "Polynésie française", "PR": "Porto Rico", "PT": "Portugal", "QA": "Qatar", "HK": "R.A.S. chinoise de Hong Kong", "MO": "R.A.S. chinoise de Macao", "QO": "régions éloignées de l’Océanie", "CF": "République centrafricaine", "CD": "République démocratique du Congo", "DO": "République dominicaine", "CZ": "République tchèque", "RE": "Réunion", "RO": "Roumanie", "GB": "Royaume-Uni", "RU": "Russie", "RW": "Rwanda", "EH": "Sahara occidental", "BL": "Saint-Barthélémy", "KN": "Saint-Kitts-et-Nevis", "SM": "Saint-Marin", "MF": "Saint-Martin", "PM": "Saint-Pierre-et-Miquelon", "VC": "Saint-Vincent-et-les Grenadines", "SH": "Sainte-Hélène", "LC": "Sainte-Lucie", "WS": "Samoa", "AS": "Samoa américaines", "ST": "Sao Tomé-et-Principe", "SN": "Sénégal", "RS": "Serbie", "CS": "Serbie-et-Monténégro", "SC": "Seychelles", "SL": "Sierra Leone", "SG": "Singapour", "SK": "Slovaquie", "SI": "Slovénie", "SO": "Somalie", "SD": "Soudan", "LK": "Sri Lanka", "SE": "Suède", "CH": "Suisse", "SR": "Suriname", "SJ": "Svalbard et Île Jan Mayen", "SZ": "Swaziland", "SY": "Syrie", "TJ": "Tadjikistan", "TW": "Taïwan", "TZ": "Tanzanie", "TD": "Tchad", "TF": "Terres australes françaises", "IO": "Territoire britannique de l'océan Indien", "PS": "Territoire palestinien", "TH": "Thaïlande", "TL": "Timor oriental", "TG": "Togo", "TK": "Tokelau", "TO": "Tonga", "TT": "Trinité-et-Tobago", "TA": "Tristan da Cunha", "TN": "Tunisie", "TM": "Turkménistan", "TR": "Turquie", "TV": "Tuvalu", "UA": "Ukraine", "EU": "Union européenne", "UY": "Uruguay", "VU": "Vanuatu", "VE": "Venezuela", "VN": "Viêt Nam", "WF": "Wallis-et-Futuna", "YE": "Yémen", "ZM": "Zambie", "ZW": "Zimbabwe" 
                }
            }
        },
        
        created(){
           // this.$store.dispatch('getMember', this.$route.params.id)
        },
        methods :{

           updateMemberData(){
                let name = this.editingMember.name
                let phone = this.editingMember.phone
                let country = this.editingMember.country
                let sexe = this.editingMember.sexe
                this.$store.commit('RESET_INVALIDS_MEMBER_EDIT', {})
                this.$store.dispatch('updateMemberData', {name, phone, sexe, country, member_id: this.editingMember.id})
           }
            
        },

        computed: mapState([
            'invalids', 'user', 'member', 'active_member', 'connected', 'invalidsEditMember', 'editingMember'
        ])
    }
</script>









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