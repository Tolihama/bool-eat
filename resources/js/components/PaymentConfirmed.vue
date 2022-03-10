<template>
  <div class="page d-flex justify-content-center align-items-center">
      <div class="container p-4">
          <div class="alert text-center row">
              <div class="col-12">
                <h1 class="text-danger">Ordine effettuato con successo </h1>
                <p>
                    Grazie per aver fatto il tuo ordine su bool-eat!
                    <br />
                    Ti abbiamo inviato un'email con il riepilogo dell'ordine.
                </p>
              </div>
              <div class="text-center">
                  <button @click="$emit('closeAlert')" class="btn btn-success mb-2 mb-md-0 mx-2">
                      Continua la navigazione
                  </button>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    name: 'PaymentConfirmed',
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