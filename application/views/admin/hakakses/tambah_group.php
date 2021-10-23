<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_content">
   <?php echo form_open_multipart('admin/simpangroup','class="form-horizontal form-label-left"') ?>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="nama" pattern=".{5,15}" required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="2" name="nama" placeholder="Fill Your Name here" required="required" type="text">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">NIK <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="nik" pattern=".{15,15}" required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nik" placeholder="Fill Your NIK here" required="required" type="number">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Lahir <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="date" pattern=".{7,15}" required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="date" placeholder="Fill Your Password here" required="required" type="date">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jenis Kelamin <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control  col-md-7 col-xs-12" id="jenis_k" name="jenis_k">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
            
            </select>
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nomor HP<span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="no" pattern=".{7,15}" required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="no" placeholder="Fill Your Password here" required="required" type="number">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="username" pattern=".{7,50}" required title="7 to 50 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="username" placeholder="Fill Your Username here" required="required" type="email">
          </div>
        </div>
   
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="password" pattern=".{7,15}" required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="password" placeholder="Fill Your Password here" required="required" type="password">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Foto Diri <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="gambar"  name="gambar"  class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"required="required" type="file">
          </div>

          
        </div>


        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            <button type="submit" class="btn btn-primary">Cancel</button>
            <button id="send" type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>