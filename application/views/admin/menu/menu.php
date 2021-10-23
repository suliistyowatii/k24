<div class="menu_section">
	<h3>General</h3>
	<ul class="nav side-menu">
		
		<?php if ($getgroup[0]->member=='1') echo '<li>'.anchor('admin/profile','<i class="fa fa-check"></i>PROFIL').'</li>' ?>

		<?php if ($username=='Administrator') echo '<li>'.anchor('admin/hakakses','<i class="fa fa-users"></i>MEMBER').'</li>' ?>

	</ul>
</div>
