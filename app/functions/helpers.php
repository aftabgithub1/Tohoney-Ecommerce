<?php

function dateFormat($date_str, $format) {
  return date_format(date_create($date_str), $format);
}

