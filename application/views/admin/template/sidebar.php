<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
       
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="treeview">
                <?php 
                 echo anchor(site_url('admin/dashboard'),' <i class="fa fa-support"></i>
                    <span>Dashboard</span>');
                ?>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-support"></i>
                    <span>Settings</span>
                    <span class="pull-right-container">
                       <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?php echo anchor(site_url('admin/city'),' <i class="fa fa-circle-o"></i> City'); ?>
                    </li>
                    <li>
                        <?php echo anchor(site_url('admin/location'),' <i class="fa fa-circle-o"></i> Location'); ?>
                    </li>
                    <li>
                        <?php echo anchor(site_url('admin/mobile_category'),' <i class="fa fa-circle-o"></i> Mobile Category'); ?>
                    </li>
                </ul>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>