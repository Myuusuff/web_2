<?php
// functions.php
function highlight($text, $keyword) {
    if (!$keyword) return $text;
    return preg_replace("/(" . preg_quote($keyword, '/') . ")/i", '<span class="highlight">$1</span>', $text);
}

?>
