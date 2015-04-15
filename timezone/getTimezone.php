<?php

$offset = timezone_offset_get( 
    new DateTimeZone( 'America/Montreal' ), 
    new DateTime() 
);
echo timezone_offset_string($offset);

function timezone_offset_string($offset){
    return sprintf("%s%02d%02d", ($offset >= 0) ? '+' : '-', abs($offset / 3600), abs($offset % 3600) );
}

?>