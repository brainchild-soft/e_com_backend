<template>
    <form action="" >
        <div class="box-border">
            <ul>
                <li class="row">
                    <div class="col-sm-6">
                        <div class="categori-search  ">
                            <chosen-select v-model='billing_id' :classList="selectOption.classList" :placeholder="selectOption.placeholder" >
                                <option value="" selected>{{ $t('checkout.select_address')}}</option>
                                <option :value="0">{{ $t('checkout.new_address')}}</option>
                                <option v-if="addressList" v-for="(address, index) in addressList" :key="index" :value="address.id" >{{ address.text }}</option>
                            </chosen-select>
                        </div>
                    </div>
                </li>
            </ul>
            <ul :class="new_address?'show':'hidden'">
                <li class="row">
                    <div class="col-sm-12">
                        <h3 class="text text-semibold text-center">{{ $t('checkout.new_address')}}</h3>
                    </div>
                </li>
                <li class="row">
                    <div class="col-sm-6">
                        <label for="first_name" class="required">{{ $t('form.first_name')}}<span class="text text-bold text-danger">*</span></label>
                        <input class="input form-control" v-model="formData.first_name"  id="first_name" type="text">
                    </div>
                    <div class="col-sm-6">
                        <label for="last_name" class="required">{{ $t('form.last_name')}}</label>
                        <input  v-model="formData.last_name"  class="input form-control" id="last_name" type="text">
                    </div>
                </li>
                <li class="row">
                    <div class="col-sm-6">
                        <label for="telephone" class="required">{{ $t('form.phone_no')}} <span class="text text-bold text-danger">*</span></label>
                        <input class="input form-control" v-model="formData.phone_no"  id="telephone" type="number">
                    </div>
                </li>
                <li class="row">
                    <div class="col-xs-12">
                        <label for="address" class="required">{{ $t('form.address')}} <span class="text text-bold text-danger">*</span></label>
                        <input class="input form-control" v-model="formData.address"  id="address" type="text">
                    </div>

                </li>
                <li class="row">
                    <div class="col-sm-6">
                        <label for="city" class="required">{{ $t('form.city')}} <span class="text text-bold text-danger">*</span></label>
                        <input class="input form-control" v-model="formData.city"  id="city" type="text">
                    </div>
                    <div class="col-sm-6">
                        <label for="district" class="required">{{ $t('form.district')}} <span class="text text-bold text-danger">*</span></label>
                        <input class="input form-control" v-model="formData.district"  id="district" type="text">
                    </div>
                </li>
                <li class="row">
                    <div class="col-sm-6">
                        <label class="required">{{ $t('form.region')}} <span class="text text-bold text-danger">*</span></label>
                        <chosen-select v-model='formData.region' :classList="selectOption.classList" :placeholder="$t('form.select_region')" >
                            <option value="">{{ $t('form.select_region')}}</option>
                            <option v-for="(region,index) in regions" :key="index" :value="region.key">{{ $t("state."+region.name) }}</option>
                        </chosen-select>
                    </div>
                    <div class="col-sm-6">
                        <label for="postal_code" class="required">{{ $t('form.postal_code')}}</label>
                        <input class="input form-control" v-model="formData.postal_code"  id="postal_code" type="number">
                    </div>
                </li>
            </ul>
            <ul>
                <li class="row">
                    <div class="col-sm-3" v-if="new_address">
                        <label for="save_address" style="padding:10px;">
                            <input  id="save_address" v-model="save_address" :value="1" type="checkbox">{{ $t('checkout.save_address_book')}}
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label for="is_shipping" style="padding:10px;">
                            <input  v-model="formData.is_shipping"  :value="1"  id="is_shipping" type="checkbox">{{ $t('checkout.also_save_address')}}
                        </label>
                    </div>
                </li>
                <li style="text-align: right">
                    <button type="button" @click.prevent="billingAddressStore" :disabled="btnDisabled" class="button">{{ $t('checkout.continue')}}</button>
                </li>
            </ul>
        </div>
    </form>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import ChosenSelect from '../../helper/ChosenSelect';

    export default {
        name: "BillingForm",
        components:{ChosenSelect},
        data(){
            return{
                formData:{
                    first_name:'',
                    last_name:'',
                    phone_no:'',
                    address:'',
                    city:'',
                    state:'',
                    postal_code:'',
                    country:'Somalia',
                    address_type:1,
                    is_shipping:0,
                    region:'',
                    district:'',
                },
                btnDisabled:false,
                billing_id:'',
                save_address:false,
                new_address:false,
                selectOption:{
                    classList:'categori-search-option',
                    placeholder:'All Address'
                },
            }
        },
        methods:{
            ...mapActions([
                'storeAddressInfo',
                'addAddressInfo',
                'getAddressInfo',
                'tabChange',
            ]),
            billingAddressStore(){
                this.btnDisabled = true;
                if(this.save_address === true && this.new_address === true){
                    if(this.formValidation() === false){
                        return false;
                    }
                    this.storeAddressInfo(this.formData)
                        .then(response=>{
                            if(typeof response.code !== "undefined" && response.code === 200){
                                this.$noty.success(response.message);
                                this.btnDisabled = false;
                                this.continueTab();
                            }else if(response.status === 'validation'){
                                this.$noty.warning(response.message);
                            }else {
                                this.$noty.error(response.message);
                            }
                        })
                }else if(this.save_address === false && this.new_address === true){
                    if(this.formValidation() === false){
                        return false;
                    }
                    this.addAddressInfo(this.formData);
                    this.btnDisabled = false;
                    this.continueTab();
                }else{
                    if(this.billing_id == ''){
                        this.btnDisabled = false;
                        this.$noty.warning('Select A Billing Address');
                        return false;
                    }
                    let reqData = {
                        address_id: this.billing_id,
                        is_shipping:this.formData.is_shipping,
                        address_type: this.formData.address_type,
                    };

                    this.getAddressInfo(reqData)
                        .then(response=>{
                            if(typeof response.code !== "undefined" && response.code === 200){
                                this.$noty.success(response.message);
                                this.btnDisabled = false;
                                this.continueTab();
                            }else if(response.status === 'validation'){
                                this.$noty.warning(response.message);
                            }else {
                                this.$noty.error(response.message);
                            }
                        })
                }
            },
            continueTab(){
                let data = {};
                if(this.formData.is_shipping === 1 || this.formData.is_shipping === true){
                    data={
                        billing:{
                            'tabAction':false,
                        },
                        shopping:{
                            'tabAction':false,
                        },
                        method:{
                            'tabAction':true,
                        },
                        payment:{
                            'tabAction':false,
                        },

                    };
                }else{
                    data={
                        billing:{
                            'tabAction':false,
                        },
                        shopping:{
                            'tabAction':true,
                        },
                        method:{
                            'tabAction':false,
                        },
                        payment:{
                            'tabAction':false,
                        },

                    };
                }

                this.tabChange(data);

            },
            formValidation(){
                if(this.formData.first_name === ''){
                    this.$noty.warning('First Name is Required');
                    return false;
                }
                if(this.formData.phone_no === ''){
                    this.$noty.warning('Phone No is Required');
                    return false;
                }
                if(this.formData.address === ''){
                    this.$noty.warning('Address is Required');
                    return false;
                }
                if(this.formData.city === ''){
                    this.$noty.warning('City is Required');
                    return false;
                }
                if(this.formData.region === ''){
                    this.$noty.warning('Region is Required');
                    return false;
                }
                if(this.formData.district === ''){
                    this.$noty.warning('District is Required');
                    return false;
                }
                return true;
            }
        },
        computed:{
            ...mapGetters([
                'addressList',
                'regions'
            ]),
            formDataCheck(){
                return JSON.parse(JSON.stringify(this.formData));
            },
        },
        watch:{
            formDataCheck:{
                handler(newVal, oldVal){
                    if(newVal !== oldVal){
                        this.btnDisabled = false;
                    }

                }
            },
            addressList:{
                handler(newVal, oldVal){
                    if(newVal.length === 0){
                        this.new_address = true;
                    }
                }
            },
            billing_id:{
                handler(newVal, oldVal){
                    if(newVal !== oldVal){
                        if(newVal == 0){
                            this.new_address = true;
                        }else{
                            this.new_address = false;
                        }
                        this.btnDisabled = false;
                    }

                }
            },
        }
    }
</script>

<style scoped>

    .show{
        display: block;
    }
    .hidden{
        display: none;
    }

</style>
