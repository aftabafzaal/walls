<!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      {{ Config('params.site_name') }}
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y');?> <a href="{{ url()}}" target="_blank" >{{ Config('params.site_name') }}</a>.</strong> All rights reserved.
  </footer>