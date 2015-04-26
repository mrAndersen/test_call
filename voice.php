<?php

if(isset($_FILES["voice_record"])){
    copy ($_FILES["voice_record"]["tmp_name"], "records/v".rand(100,99999)."wav");
}
