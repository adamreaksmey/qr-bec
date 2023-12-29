<!DOCTYPE html>
<html lang="en">

<x-head />

<body>
    <div class="flex flex-col justify-center h-screen items-center gap-10 w-full" style="height: 100vh">
        <div class="text-3xl font-bold lead-title">
            <span class="come">{{ __('messages.arrived_message') }}</span>
            <span class="go">{{ __('messages.left_message') }}</span>
        </div>
        <div class="flex justify-center text-center description">
            <span class="come">{{ __('messages.final_notice_arrived') }}</span>
            <span class="go">{{ __('messages.final_notice_left') }}</span>
        </div>
        <div class="flex justify-center items-end">
            <x-refresh-button />
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        const url = new URL(window.location.href);
        const searchParams = new URLSearchParams(url.search);
        const paramValue = searchParams.get('status');

        if (paramValue == "arrived") {
            $(".come").show();
            $('.go').hide();
        } else {
            $(".go").show();
            $('.come').hide();
        }
    })
</script>

</html>
