


       

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?=$judul?></h1>
<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
        <img src="<?=base_url('assets/img/profile')?>/air.jpg" class="card-img " alt="default">
    </div>
    <div class="col-md-8">
        <div class="card-body">
            <h5 class="card-title"><?=$user['name']?></h5>
            <p class="card-text"><?=$user['email']?></p>
            <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_create'])?></small></p>
        </div>
    </div>
      </div>
    </div>
  </div>
</div>
                