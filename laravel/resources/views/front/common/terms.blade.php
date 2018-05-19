<div class="terms col-sm-12">
    <div style="display: none;" class="terms-errors alert alert-danger">
    </div>
    <input type="checkbox" name="terms" id="terms" $required >
    I accept the <a target="_black" href="{{url('terms')}}" >Terms of Service</a>.
</div>
<script>
    function check_terms_services() {
        var terms = jQuery("#terms").prop("checked");

        if (terms == false) {
            $('.terms-errors').show();
            $('.terms-errors').text('Please accept our terms of service.');
            $('.terms-errors').addClass('alert alert-danger');

            return false;
        }

    }
</script>