<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $judul ?></h1>


  <div class="row">
    <div class="col-lg-8">
      <?= form_open_multipart('user/edit') ?>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label" id="email">Email</label>
        <div class="col-sm-10">
          <input type="text" value="<?= $user['id_user']; ?>" name="id" hidden="hidden">
          <input type="text" class="form-control" value="<?= $user['email']; ?>" readonly="" name="email" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label" id="name">Full Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="name" value="<?= $user['name']; ?>">
          
          <?= form_error('name', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-2">Picture</div>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-3">
              <img src="<?= base_url('assets/img/profile/' . $user['image']); ?>" alt="<?= $user['name']; ?>"
                class="img-fluid">
            </div>
            <div class="col-9">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="fileName" name="image">
                <label class="custom-file-label" for="fileName">Select Image: .jpg, .png or .jpeg max size 2000
                  kb</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
        </form>
      </div>
    </div>

  </div>
</div>