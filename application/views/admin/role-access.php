<!-- DataTales Example -->
<div class="container mt-3">
    
<?=$this->session->flashdata('changeaccess');?>
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex justify-content-between">
		  	<h6 class="m-0 mt-1 font-weight-bold text-primary">Role: <?= $role['role']; ?></h6>
		  	<a href="<?= base_url('admin/role'); ?>" class="btn-sm btn-secondary">&larr; Back</a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
			    <table class="table table-bordered table-striped table-hover" cellspacing="0">
			      <thead>	
			        <tr>
						<th style="">No</th>
						<th style="width: 85%; min-width: 200px;">Menu</th>
						<th style="width: 10%; min-width" class="text-center">Access</th>
			        </tr>
			      </thead>
			      <tbody>
			      	<?php 
			      	$i = 0;
                    foreach ($menu as $m) :
			      	?>
			      	<tr>
			      		<td class="text-center"><?= ++$i; ?></td>
			      		<td><?=$m['menu']?></td>
			      		<td>
			      			<div class="form-check justify-content-center d-flex">
							  <input type="checkbox" class="form-check-input" <?= check_access($role['id_role'], $m['id_menu']); ?> data-role="<?= $role['id_role']; ?>" data-menu="<?= $m['id_menu']; ?>" data-url="<?= base_url(); ?>">
			      			</div>
			      		</td>
			      	</tr>
                            <?php endforeach?>
				    
			      </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>

