<?php 
$mecab_path = 'MeCab\bin\mecab.exe';
$input_file = 'target.txt';

exec("$mecab_path $input_file", $result);

$word_list_index = array();
$word_list = array();

foreach ($result as $val) {
    $tmp = explode(",", $val);
    $tmp = explode("\t", $tmp[0]);

    if (isset($tmp[1]) && $tmp[1] == '–¼ŽŒ') {
        $key = array_search($tmp[0], $word_list_index);
        if ($key === false) {
            $word_list[] = array('num' => 1, 'word' => $tmp[0]);
            $word_list_index[] = $tmp[0];
        } else {
            $word_list[$key]['num'] = $word_list[$key]['num'] + 1;
        }
    }
}
unset($word_list_index);

arsort($word_list);
foreach ($word_list as $val) {
    echo $val['num'] . "\t" . $val['word'] . "\n";
}
