<template>
    <div id="checkout" class="d-flex flex-column w-100 py-5">
        <div class="container p-3" v-if="order">
            <div class="row">
                <section class="col-md-12 col-lg-8 p-2">
                    <!-- Form dati del cliente -->
                    <div class="box py-3">
                        <h2 class="p-3">Dati del cliente</h2>
                        <form action="" id="multistepsform">
                            <ul id="progressbar">
                                <li id="1_step" class="active">
                                    Informazioni del Cliente
                                </li>
                                <li id="2_step" >
                                    Recapiti del Cliente
                                </li>
                                <li id="3_step">
                                    Informazioni di Pagamento
                                </li>
                            </ul>
                            <fieldset id="1_slide" class="active">
                                <label for="customer_name">Nome e cognome cliente</label>
                                <input 
                                type="text" 
                                id="customer_name" 
                                name="customer_name" 
                                class="form-control"
                                required 
                                maxlength="50"
                                v-model.trim="customerName"
                                >
                                <div v-for="(error, i) in errors.customer_name" :key="`err-name-${i}`" class="text-danger">
                                {{error}}
                                </div>
                                <label for="customer_address">Indirizzo di consegna</label>
                                <input 
                                type="text" id="customer_address" name="customer_address" 
                                class="form-control"
                                required 
                                maxlength="150"
                                v-model.trim="customerAddress"
                                >
                                <div v-for="(error, i) in errors.customer_address" :key="`err-address-${i}`" class="text-danger">
                                {{error}}
                                </div>
                                <input type="button" name="next" @click="onClickNext(2)" class="next action-button" value="Avanti">
                            </fieldset>
                            <fieldset id="2_slide">
                                <label for="customer_phone">Riferimento telefonico</label>
                                <input 
                                    type="text" 
                                    id="customer_phone" 
                                    name="customer_phone" 
                                    class="form-control"
                                    minlength="11"
                                    maxlength="30"
                                    required 
                                    v-model.trim="customerPhone"
                                >
                                <div v-for="(error, i) in errors.customer_phone" :key="`err-phone-${i}`" class="text-danger">
                                    {{error}}
                                </div>   
                                <label for="customer_email">Email</label>
                                <input 
                                    type="email" 
                                    id="customer_email" 
                                    name="customer_email" 
                                    class="form-control"
                                    required
                                    maxlength="50"
                                    v-model.trim="customerEmail"
                                >
                                <div v-for="(error, i) in errors.customer_email" :key="`err-email-${i}`" class="text-danger">
                                    {{error}}
                                </div>   
                                <label for="notes">Informazioni aggiuntive da comunicare al ristorante</label>
                                <textarea
                                    id="notes" 
                                    rows="2"
                                    name="notes" 
                                    class="form-control"
                                    v-model.trim="notes"
                                ></textarea>
                                <input type="button" name="previous" @click="onClickPrevious(1)"  class="previous action-button" value="Indietro" />
                                <input type="button" name="next" @click="onClickNext(3)"  class="next action-button" value="Avanti" />
                            </fieldset>
                            <fieldset id="3_slide">
                                <h5 class="text-danger" v-if="errors.length>0">Go back and check the form data</h5>
                                <div v-for="(error, i) in errors" :key="`err-${i}`" class="text-danger">
                                    <span v-for="(el, i) in error" :key="`el-${i}`">{{el}}</span>
                                </div>
                                <v-braintree 
                                    v-if="token"
                                    :authorization="token"
                                    @success="onSuccess"
                                    @error="onError"
                                >
                                </v-braintree>
                                <input type="button" name="previous" @click="onClickPrevious(2)"  class="previous action-button" value="Indietro" />
                                
                            </fieldset>
                        </form>
                            
                    </div>
                </section>

                <section class="col-md-12 col-lg-4 p-2">
                    <!-- Riepilogo ordine box -->
                    <div class="box py-3">
                        <h2 class="p-3">
                            Riepilogo ordine<span v-if="restaurantName"> da {{ restaurantName }}</span>
                        </h2>
                        <div 
                            class="dish row px-3"
                            v-for="dish in order"
                            :key="`dish-${dish.id}`"
                        >
                            <div class="col-6 py-1">
                                {{ dish.name }}
                            </div>
                            <div class="col-6 py-1">
                                {{ dish.quantity }} x {{ dish.price }}€ = {{ dish.price * dish.quantity }}€
                            </div>
                        </div>
                        <div class="total row px-3 fw-bold">
                            <div class="col-6 offset-6 py-1 fw-bold">
                                Totale: {{ totalOrder }}€
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <Loader v-else />
        
    </div>
</template>

<script>
import axios from 'axios';
// import braintree from 'braintree-web';

// Components
import Loader from '../components/Loader';

export default {
    name: 'Checkout',

    components: {
        Loader
    },

    data() {
        return {
            order: null,
            restaurantName: null,
            restaurantId: null,

            // Form customer data
            customerName: null,
            customerAddress: null,
            customerPhone: null,
            customerEmail: null,
            notes: null,
            errors: {},

            // Braintree customer token
            token: null,
        }
    },

    computed: {
        totalOrder() {
            let total = 0;
            this.order.forEach(dish => {
                total += parseFloat(dish.price) * dish.quantity;
            });
            return total;
        }
    },

    created() {
        this.tokenRequest();
    },

    mounted() {
        if (localStorage.getItem('currentOrder')) {
            try {
                this.order = JSON.parse(localStorage.getItem('currentOrder'));
            } catch(e) {
                localStorage.removeItem('currentOrder');
            }
        }

        if (localStorage.getItem('currentRestaurantOrder')) {
            try {
                const restaurantOrder = JSON.parse(localStorage.getItem('currentRestaurantOrder'));
                this.restaurantName = restaurantOrder.restaurantName;
                this.restaurantId = restaurantOrder.restaurantId;
            } catch(e) {
                localStorage.removeItem('currentRestaurantOrder');
            }
        }
    },

    methods: {

        /**
         * Braintree payment functionality function
         */
        onSuccess (payload) {
            let nonce = payload.nonce;
            // Do something great with the nonce...
            this.payment(nonce);
        },

        onError (error) {
            let message = error.message;
            // Whoops, an error has occured while trying to get the nonce
            console.log(message);
        },

        tokenRequest() {
            axios.get('http://127.0.0.1:8000/api/payment-token')
                .then(res => {
                    this.token = res.data;
                })
                .catch(err => console.log(err));
        },

        payment(nonce) {
            axios.post('http://127.0.0.1:8000/api/payment-request', {
                payment_method_nonce: nonce,
                order: this.order,
                customer: {
                    customer_name: this.customerName,
                    customer_address: this.customerAddress,
                    customer_phone: this.customerPhone,
                    customer_email: this.customerEmail,
                    notes: this.notes,
                    restaurant_id: this.restaurantId,
                }
            })
            .then(res => {
                if(res.data.errors){
                    this.errors = res.data.errors;
                }
                console.log(res);
            })
            .catch(err => console.log(err));
        },

        /**
         * Form functionality functions
         */
        onClickNext(slide_id){
            const next_slide=document.getElementById(`${slide_id}_slide`);
            const slide=document.getElementById(`${(slide_id-1)}_slide`);
            const next_step=document.getElementById(`${slide_id}_step`);  
            if(!this.validateSlide(slide)){
                return;
            }
            next_step.classList.add("active");
            slide.classList.remove("active");
            next_slide.classList.add("active");

        },

        onClickPrevious(slide_id){
            const previous_slide=document.getElementById(`${slide_id}_slide`);
            const slide=document.getElementById(`${(slide_id+1)}_slide`);
            const step=document.getElementById(`${(slide_id+1)}_step`);
            step.classList.remove("active");
            slide.classList.remove("active");
            previous_slide.classList.add("active");
        },

        validateSlide(slide){
            let inputsValid = true;
            const inputs=slide.querySelectorAll("input");
            for (let i = 0; i < inputs.length; i++) {
                const valid = inputs[i].checkValidity();
            if (!valid) {
                inputsValid = false;
                inputs[i].classList.add("invalid-input");
            } else {
                inputs[i].classList.remove("invalid-input");
            }  
        }
        return inputsValid;
        }
    }
}

</script>

<style lang="scss" scoped>
#checkout > .container section .box {
    border-radius: 20px;
    box-shadow: 0 0 5px 1px #ccc;
}
#multistepsform {
  width: 80%;
  margin: 50px auto;
  text-align: center;
  position: relative;

  fieldset {
    display:none;
    background: white;
    border: 0 none;
    border-radius: 3px;
    box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
    padding: 20px 30px;
    box-sizing: border-box;
    width: 80%;
    margin: 0 10%;
    position: relative;
    opacity: 0;
    transition: all 1s ease-in-out;
  }
  .active {
      opacity: 1;
      display:block;
  }
  input,
  textarea {
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 10px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2c3e50;
    font-size: 13px;
    &:focus {
      border-color: #679b9b;
      outline: none;
      color: #637373;
    }
  }
  .invalid-input {
      border: 2px solid red;
  }

  .action-button {
    width: 100px;
    background: #ff9a76;
    font-weight: bold;
    color: #fff;
    transition: 150ms;
    border: 0 none;
    border-radius: 1px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
  }
  .action-button:hover,
  .action-button:focus {
    box-shadow: 0 0 0 1px #f08a5d, 
                0 0 0 2px #ffa976;
    color: #fff;
  }
  .fs-title {
    font-size: 15px;
    text-transform: uppercase;
    color: #2c3e50;
    margin-bottom: 10px;
  }
  .fs-subtitle {
    font-weight: normal;
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
  }
  #progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    counter-reset: step;
    li {
      list-style-type: none;
      color: #679b9b;
      text-transform: uppercase;
      font-size: 9px;
      width: 33.33%;
      float: left;
      position: relative;
      transition: all 0.3s ease-in-out;
      &:before {
        content: counter(step);
        counter-increment: step;
        width: 20px;
        line-height: 20px;
        display: block;
        font-size: 10px;
        color: #fff;
        background: #679b9b;
        border-radius: 3px;
        margin: 0 auto 5px auto;
        transition: all 0.5s;
      }
      &:after {
        content: "";
        width: 100%;
        height: 2px;
        background: #679b9b;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: -1;
      }
      &:first-child:after {
        content: none;
      }
    }
    li.active {
      color: #ff9a76;
      &:before,
      &:after {
        background: #ff9a76;
        color: white;
      }
    }
  }
}
</style>