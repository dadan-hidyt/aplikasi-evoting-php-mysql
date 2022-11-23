<?php echo "Fitur segera ada!";exit; ?>
<style>
.checkbox{
  height: 30px;
  width: 14%;
  padding: 0px;
  display: flex;
  background: #fff;
  align-items: center;
  border-radius: 5px;
  justify-content: space-between;
}
.checkbox input{
  outline: none;
  height: 20px;
  width: 50px;
  border-radius: 50px;
  -webkit-appearance: none;
  position: relative;
  background: #e6e6e6;
  box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
  transition: 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.checkbox input:checked{
  background: #664AFF;
}
.checkbox input:before{
  position: absolute;
  content: "";
  left: 0;
  height: 100%;
  width: 20px;
  background: linear-gradient(#fff,#f2f2f2,#e6e6e6,#d9d9d9);
  box-shadow: 0 2px 5px rgba(0,0,0,.2);
  border-radius: 50px;
  transform: scale(0.85);
  transition: left 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
input:checked:before{
  left: 30px;
}
.checkbox .text:before{
  content: "Tidak Aktif";
  font-size: 16px;
  font-weight: 500;
  color: #bfbfbf;
}
input:checked ~ .text:before{
  color: #664AFF;
  font-size: 16px;
  content: "Aktif";
}
</style>
<div class="col-md-12 bg-white p-4">
    <h3>Pengaturan</h3>
    <div id="pengaturan-umum">
       <div class="group">
           <span>Aktifkan Pemilihan</span>
           <div class="checkbox">
            <input type="checkbox"  name='aktifkan_pemilihan' id="click">
            <label for="click" class="text"></label>
        </div>
       </div>
       <div class="group">
           <span>Maintenance</span>
           <div class="checkbox">
            <input type="checkbox" id="click">
            <label for="click" class="text"></label>
        </div>
       </div>
    </div>
</div>
<script>

</script>