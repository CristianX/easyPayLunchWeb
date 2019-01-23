<template>
  <div id="app">
    <div class="container">
      <div class= "row mt-5">
        <div class="col sm-4">
          <div class="card">
            <div class="card-header">
              <h3>Agrega nuevo Pedido</h3>
            </div>
            <div class="card-body">
              <form @submit="addPedios">
                <div class="form-group">
                  <input type="text" class="form-control" v-model="nuevoPedido.descripcion" placeholder="Descripción">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" v-model="nuevoPedido.estado" placeholder="Estado">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" v-model="nuevoPedido.imagen" placeholder="Imagen">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" v-model="nuevoPedido.nombre" placeholder="Nombre">
                </div>
                <button type="submit" class="btn btn-primary">
                  Guardar
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-sm-8 text-center">
          <div class="card">

            <div class="card-header">
              <h3>Lista de Pedidos</h3>
            </div>

            <div class="card-body">

              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                  </tr>
                </thead>
              </table>
              <tbody>

                <tr v-for="ped in pedidos">

                  <td>
                    {{ped.descripcion}}
                  </td>

                </tr>

              </tbody>
            </div>
          </div>
        </div>
    </div>

    </div>
  </div>

</template>

<script>
  import Firebase from 'firebase';
  import config from './config.js';

  let app = Firebase.initializeApp(config);
  let db = app.database();
  let pedidosRef = db.ref('prueba');

  export default {
    name: 'App',

    firebase: {
      pedios: pedidosRef
    },

    data() {

      return {
        nuevoPedido: {
          descripcion: '',
          estado: '',
          imagen: '',
          nombre: ''
        }
      }

    },

    methods: {
      addPedidos(){
        pedidosRef.push(this.nuevoPedido);
        this.nuevoPedido.descripcion = '';
        this.nuevoPedido.estado = '';
        this.nuevoPedido.imagen = '';
        this.nuevoPedido.nombre = '';
      }
    }


  }

</script>
