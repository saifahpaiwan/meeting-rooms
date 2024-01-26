@if ($message = Session::get('errors'))
<div class="alert bg-danger text-danger alert-dismissible fade show position-alert align-items-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex justify-content-start align-items-center">
        <div class="p-1"><i class="fe-x-circle alert-icon-size text-white"></i></div>
        <div class="ml-2">
            <h5 class="text-white">Warning!</h5>
            <p class="m-0 text-white">
                <?php
                if (isset($message) && !empty($message)) {
                    if (is_object($message)) {
                        foreach ($message->all() as $key => $error) {
                            echo ($key + 1) . ". " . $error . "<br>";
                        }
                    } else {
                        echo $message;
                    }
                } else {
                    echo 'มีปัญหาบางอย่างกับข้อมูลที่คุณป้อน.';
                }
                ?>
            </p>
        </div>
    </div>
</div>
@endif