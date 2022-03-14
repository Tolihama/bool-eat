<template>
  <div class="page d-flex justify-content-center align-items-center">
      <div class="container p-4">
          <div class="alert text-center row">
              <div class="col-12">
                <h1 class="text-danger">Attenzione</h1>
                <p>
                    Puoi ordinare da un solo ristorante alla volta, vuoi svuotare il carrello e continuare con il nuovo ordine?
                </p>
              </div>
              <div class="text-center">
                  <button @click="$emit('closeAlert')" class="btn btn-booleat mb-2 mb-md-0 mx-2">
                      Continua
                  </button>
                  <router-link
                    :to="{
                        name: 'restaurant',
                        params: {
                            slug: link
                        }
                    }" 
                    class="btn btn-booleat-alt mb-2 mb-md-0 mx-2">
                      Torna al mio ordine
                  </router-link>
                
              </div>
              
          </div>
      </div>
  </div>
</template>

<script>
export default {
    name: 'Alert',
    props: {
        link: String,
    }

}
</script>

<style lang="scss" scoped>
    .page {
        background: rgba($color: #000000, $alpha: 0.5);
        position: fixed;
        top: 0;
        bottom: 0;
        z-index: 5;
        width: 100%;
        height: 100%;
        .alert {
            // max-width: 300px;
            border-radius: 20px;
            background: #fff;
        }
    }
</style>