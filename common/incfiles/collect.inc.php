<?php
//****************************************************
// WDJA CMS Power by wdja.net
// Email: admin@wdja.net
// Web: http://www.wdja.net/
//****************************************************
ini_set('user_agent','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0');

require('HtmlDom.php');

function collects($url) {
  $collect = array();
  $data = array();
  $collect = api_collect_array();
  $dom = file_get_html($url);
  if (!$dom) {
    return false;
  }
  $dom = wdja_iconv($dom);
  if(!empty($collect)){
    $burl = parse_url($url,PHP_URL_HOST);
    foreach($collect as $rule){
      if($rule['c_url'] == $burl){
        foreach($rule as $k => $v){
          $key = ii_get_lrstr($k, '_', 'rightr');
          $$key = $rule[$k];
        }
      }
    }
    if(!ii_isnull($image)){
      $timage = $dom->find($image, 0)->content;
      $timage = wdja_iconv(trim(saveimage($timage)));
      $data['image'] = ii_htmlclear($timage);
    }
    else $data['image'] = '';
    if(!ii_isnull($title)){
      $ttitle = $dom->find($title, 0)->innertext;
      $ttitle = wdja_iconv(trim($ttitle));
      $data['title'] = ii_htmlclear($ttitle);
    }
    else $data['title'] = '';
    if(!ii_isnull($author)){
      $tauthor = $dom->find($author, 0)->innertext;
      $tauthor = wdja_iconv(trim($tauthor));
      $data['author'] = ii_htmlclear($tauthor);
    }
    else $data['author'] = '';
    if(!ii_isnull($content)){
      $tcontent = $dom->find($content, 0)->innertext;
      $tcontent = wdja_iconv(trim($tcontent));
      $tcontent = str_replace('src="//', 'src="http://', $tcontent);
      $tcontent = str_replace('src="/', 'src="http://'.$burl.'/', $tcontent);
      if(!ii_isnull($replace)){
        $replaces=explode("\r\n", trim($replace));
        foreach($replaces as $k=>$v) {
          if(!ii_isnull($v)){
            $old = ii_get_lrstr($v, '|', 'left');
            $new = ii_get_lrstr($v, '|', 'right');
            $tcontent = str_replace($old, $new, $tcontent);
          }
        }
      }
      $data['content'] = ii_htmlclear(saveimages($tcontent),'-1');
    }
    else $data['content'] = '';
  }else{
    $data['image'] = '';
    $data['title'] = '';
    $data['author'] = '';
    $data['content'] = '';
  }
  if($data['image'] == '' && $data['content'] != ''){
      preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $data['content'], $strResult, PREG_PATTERN_ORDER); 
      $n = count($strResult[1]);
      if ($n > 0) $data['image'] = $strResult[1][0]; 
  }
  return $data;
}

function get_collect_tdk($url) {
  $data = array();
  if (empty($url)) return $data;
  if (substr($url, 0, 4) != 'http') $url = 'http://'.$url;
  if (substr($url, -1, 1) != '/') $url = $url.'/';
  $dom = file_get_html($url);
  if (!$dom) return $data;
  $dom = wdja_iconv($dom);
  if (!empty($dom)){
    $icon = $dom->find('link[rel="shortcut icon"],href', 0)->href;
    if(empty($icon)) $icon = $dom->find('link[rel=icon],href', 0)->href;
    if (!empty($icon)){
        if (substr($icon, 0, 1) == '/' && substr($icon, 0, 4) != 'http' && substr($icon, 0, 2) != '//') $icon = $url.ii_get_lrstr($icon, '/', 'rightr');
        if (substr($icon, 0, 2) == '//') $icon = 'http:'.$icon;
        $icon = saveimage($icon);
    }
    $title = $dom->find('title', 0)->innertext;
    $keywords = $dom->find('meta[name=keywords],content', 0)->content;
    if(empty($keywords)) $keywords = $dom->find('meta[name=Keywords],content', 0)->content;
    $description = $dom->find('meta[name=description],content', 0)->content;
    if(empty($description)) $description = $dom->find('meta[name=Description],content', 0)->content;
    $data['url'] = wdja_iconv(trim($url));
    $data['title'] = wdja_iconv(trim($title));
    $data['keywords'] = wdja_iconv(trim($keywords));
    $data['description'] = wdja_iconv(trim($description));
    $data['icon'] = wdja_iconv(trim($icon));
  }else{
    $data['url'] = '';
    $data['title'] = '';
    $data['keywords'] = '';
    $data['description'] = '';
    $data['icon'] = '';
  }
  return $data;
}

function wdja_iconv($str){
    $s1 = iconv('gbk','utf-8//IGNORE',$str);
    $s0 = iconv('utf-8','gbk//IGNORE',$s1);
    if($s0 == $str){
        return $s1;
    }else{
        return $str;
    }
}

//****************************************************
// WDJA CMS Power by wdja.net
// Email: admin@wdja.net
// Web: http://www.wdja.net/
//****************************************************
?>