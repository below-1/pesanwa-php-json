<?php
    include "koneksi.php";
    require 'funtion.php';

    $mahasiswa = query ("SELECT * FROM siswa");
    //var_dump($siswa);die;
    //tombol cari 
    if (isset($_POST["cari"])) {
       $mahasiswa = cari($_POST["keyword"]);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Web Sederhana </title>
    <script src="js/jquery.min.js"></script> 
</head>
<body>
    <div id="vue-app">
        <ul>
            <li><a href="index.php">Data</a></li>
            <li><a href="form_upload.html">upload data</a></li>
        </ul>
        <form action="" method="post">
            <input type="text" name="pesan" size="30" placeholder="masukan pesan" >
            <button type="submit" name="simpan">simpan</button>
        </form>
        <?php
            if(isset($_POST['simpan'])){
                //var_dump($_POST); 
                //var_dump ($_FILES);die;
                if(tambah ($_POST) > 0){
                    echo " 
                        <script>
                            alert('data berhasil disimpan');
                            document.location.href = 'index.php';
                        </script>
                    ";
                }else{
                    echo " 
                        <script>
                            alert('data gagal disimpan');
                            document.location.href = 'index.php';
                        </script>
                    ";
                }
            }
        ?>
        <br>
        <form action="" method="post">
            <input type="text" name="keyword" size="30" autofocus="" placeholder="masukan pencarian" autocomplete="off">
            <button type="submit" name="cari">cari</button>
        </form>
       <!---tabel--->
        <br>
        <table class="table table-striped" border="5">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Nama</th> 
                    <th>No hp</th>
                    <th>Asal sekolah</th>
                    <th>Pesan</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="item in items">
                    <tr :key="item.id_siswa">
                        <td><input type='checkbox' class='check-item' v-model="item.selected" />
                        <td><input v-model="item.nama" /></td>
                        <td><input v-model="item.nohp" /></td>
                        <td><input v-model="item.asalsekolah" /></td>
                        <td><input v-model="item.id_pesan" /></td>
                    </tr>
                </template>
            </tbody>
        </table>
        <hr>
        <button type="button" id="btn-delete" @click="send">Kirim</button>
    </div>
    
              
    <!---tabel--->
    <script src="/js/vue.js"></script>
    <script src="/js/axios.min.js"></script>
    <script>
            $(document).ready(function(){ 
                $("#check-all").click(function(){ 
                    if($(this).is(":checked")) 
                        $(".check-item").prop("checked", true); 
                    else 
                        $(".check-item").prop("checked", false); 
                });
                
                $("#btn-delete").click(function(){ 
                    // var confirm = window.confirm("Apakah Anda yakin ingin mengirim pesan ini?"); 
                    // if(confirm)
                    //     $("#form-delete").submit(); 
                });
            });
    </script>
    <script>
        var vueApp = new Vue({
            el: '#vue-app',
            data: {
                items: <?php echo json_encode($mahasiswa); ?>.map(item => ({
                    ...item,
                    selected: false
                }))
            },
            methods: {
                send () {
                    let selected = this.items.filter(it => it.selected);
                    selected.forEach(it => {
                        let url = `https://api.whatsapp.com/send?phone=${it.nohp}&text=${encodeURIComponent(it.id_pesan.trim())}`;
                        window.open(url, '_blank');
                    });
                }
            }
        });
        console.log(vueApp);
    </script>
</body>
</html>
