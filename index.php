<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Vue Js Demo</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <div id="app">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="lead-form">
              <h1 class="text-center">Real-time Google Map</h1>
              <hr/>
              <div class="row">
                <div class="col-md-12">
                  <?php

                  	//Get Data Provinsi
                  	$curl = curl_init();

                  	curl_setopt_array($curl, array(
                  	  CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
                  	  CURLOPT_RETURNTRANSFER => true,
                  	  CURLOPT_ENCODING => "",
                  	  CURLOPT_MAXREDIRS => 10,
                  	  CURLOPT_TIMEOUT => 30,
                  	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  	  CURLOPT_CUSTOMREQUEST => "GET",
                  	  CURLOPT_HTTPHEADER => array(
                  	    "key: b6dafd27f37c221ed643530d9c599c45"
                  	  ),
                  	));

                  	$response = curl_exec($curl);
                  	$err = curl_error($curl);
                    ?>
                    <!-- v-model="place" -->
                  	<label for="">Provinsi</label>
                  	<select name='provinsi' style='width: 100%;' id="provinsi">
                  	<option>Silahkan Pilih Provinsi</option>
                    <?php
                    $data = json_decode($response, true);
                  	for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                      ?>
                      <option value="<?php echo $data['rajaongkir']['results'][$i]['province_id'];?>"><?php echo $data['rajaongkir']['results'][$i]['province'];?></option>
                      <?php
                    }
                  ?>
                  </select><br><br>
                  <!-- //Get Data Provinsi -->

                  <!-- <input type="text" class="form-control input-lg" placeholder="Enter Place Name"> -->

                  <label for="">Kota</label>
                  <select id="kota" class="" name="kota" v-model="place" style="100%;">
                    <option value="">Silahkan Pilih Kota berdasarkan Provinsi</option>
                  </select>
                </div>
                <!-- <div class="col-md-6"><h3> Latitude : {{ latitude }}</h3></div>
                <div class="col-md-6"><h3> Longitude : {{ longitude }}</h3></div> -->
                <div class="col-md-12"  v-bind:class="{ 'not-visible' : active }" >
                    <iframe frameborder="0" style="width: 100%; height: 350px; border:0" v-bind:src="'https://www.google.com/maps/embed/v1/place?key=AIzaSyCSdxjuCPhzR8BbQe3-crU3qoSC-_ymQBg&q='+ place" allowfullscreen></iframe>
                </div>
              </div>
            </div><!-- end of .lead-form -->
          </div> <!-- end of .col-md-6.col-md-offset-3 -->
        </div> <!-- end of .row -->
      </div> <!-- end of .container -->
    </div> <!-- end of #app -->
  </body>
  <script src="https://unpkg.com/vue@2.0.3/dist/vue.js"></script>
  <script src="https://unpkg.com/axios@0.12.0/dist/axios.min.js"></script>
  <script src="https://unpkg.com/lodash@4.13.1/lodash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="main.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $('#provinsi').change(function(){

        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
        var prov = $('#provinsi').val();

        $.ajax({
            type : 'GET',
            url : 'http://localhost/LatihanAPI/GoogleMapsApi/GoogleVue/kota.php',
            data :  'prov_id=' + prov,
               success: function (data) {

        //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
               $("#kota").html(data);
            }
        });
      });
    });
  </script>
  <script>
    $(document).ready(function () {
        $("#provinsi").select2({
            placeholder: "Silahkan pilih provinsi"
        });
    });
  </script>
</html>
