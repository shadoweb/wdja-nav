<?php
//****************************************************
// WDJA CMS Power by wdja.net
// Email: admin@wdja.net
// Web: http://www.wdja.net/
//****************************************************
class cc_cache
{
  public $filename;
  public $cachename;

  function get_file_text()
  {
    return file_get_contents($this -> filename);
  }

  function put_file_text($data)
  {
    return file_put_contents($this -> filename, $data);
  }

  function get_file_array()
  {
    return include_once($this -> filename);
  }

  function set_file_array($data)
  {
    if (!is_array($data))
    {
      return false;
    }
    else
    {
      $tarraytext = 'array(';
      foreach($data as $key => $val)
      {
        if (is_array($val))
        {
          $tarraytext = $tarraytext . '\'' . $key . '\' => ' . $this -> set_file_array($val) . ',';
        }
        else
        {
          $tarraytext = $tarraytext . '\'' . $key . '\' => \'' . $val . '\',';
        }
      }
      $tarraytext = $tarraytext . ')';
      return $tarraytext;
    }
  }

  function put_file_array($data)
  {
    $ttext = '<?php' . chr(13) . chr(10);
    $ttext = $ttext . '$GLOBALS[\'' . $this -> cachename . '\'] = ';
    $ttext = $ttext . $this -> set_file_array($data) . ';' . chr(13) . chr(10);
    $ttext = $ttext . '?>';
    return file_put_contents($this -> filename, $ttext);
  }
}

class cc_cutepage
{
  public $id;
  public $sqlstr;
  public $offset;
  public $pagesize;
  public $rslimit;
  public $urlid;

  function init()
  {
    $trscount = $this -> get_rs_count();
    if (!isset($this -> rslimit)) $this -> rslimit = $trscount;
    else
    {
      if ($trscount < ($this -> rslimit)) $this -> rslimit = $trscount;
    }
  }

  function get_rs_count()
  {
    global $conn;
    $tsqlstr = 'select count(' . $this -> id . ') from (' . $this -> sqlstr .') as sum';
    $trs = ii_conn_query($tsqlstr, $conn);
    $trs = ii_conn_fetch_array($trs);
    return $trs[0];
  }

  function get_rs_array()
  {
    global $conn;
    $toffset = $this -> offset;
    $tpagesize = $this -> pagesize;
    $trslimit = $this -> rslimit;
    if (!($toffset > $trslimit))
    {
      if (($toffset + $tpagesize) > $trslimit) $tpagesize = $trslimit - $toffset;
      $tsqlstr = $this -> sqlstr . ' limit ' . $toffset . ',' . $tpagesize;
      $trs = ii_conn_query($tsqlstr, $conn);
      $ti = 0;
      while ($trow = ii_conn_fetch_array($trs))
      {
        $tarray[$ti] = $trow;
        $ti += 1;
      }
      return $tarray;
    }
  }

  function get_pagestr($type = 'list') 
  {
    global $nurltype;
    $toffset = $this -> offset;
    $tpagesize = $this -> pagesize;
    $trslimit = $this -> rslimit;
    $turlid = $this -> urlid;
    $turlid = ii_get_num($turlid);
    if(ii_isnull($tpagesize) || $tpagesize == 0) $tpagesize = 20;
    $tpagenums = @ceil($trslimit / $tpagesize);
    $tnpagenum = @ceil($toffset / $tpagesize) + 1;
    if ($tnpagenum > $tpagenums) $tnpagenum = $tpagenums;
    $txpagenum = $tnpagenum + 1;
    if ($txpagenum > $tpagenums) $txpagenum = $tpagenums;
    $tstate1 = ($toffset > 0) ? 1 : 0;
    $tstate2 = (($toffset + $tpagesize) < $trslimit) ? 1 : 0;
    $tmpstr = ii_itake('global.tpl_common.cutepage', 'tpl');
    $tpl_firstpage = ii_ctemplate($tmpstr, '{@firstpage}');
    $tary = explode('{|}', $tpl_firstpage);
    if ($tstate1)
    {
      $tstr = $tary[1];
      if ($type == 'search') $tstr = str_replace('{$URLfirst}', ii_iurl('searchpage', $turlid, $nurltype , 'urlkey=' . $toffset - $tpagesize), $tstr);
      else $tstr = str_replace('{$URLfirst}', ii_iurl('listpage', $turlid, $nurltype, 'urlkey=' . $toffset - $tpagesize), $tstr);
    }
    else $tstr = $tary[0];
    $tmpstr = str_replace(WDJA_CINFO, $tstr, $tmpstr);
    $tpl_prepage = ii_ctemplate($tmpstr, '{@prepage}');
    $tary = explode('{|}', $tpl_prepage);
    if ($tstate1)
    {
      $tstr = $tary[1];
      if ($type == 'search') $tstr = str_replace('{$URLpre}', ii_iurl('searchpage', $turlid, $nurltype , 'urlkey=' . $toffset - $tpagesize), $tstr);
      else $tstr = str_replace('{$URLpre}', ii_iurl('listpage', $turlid, $nurltype , 'urlkey=' . $toffset - $tpagesize), $tstr);
    }
    else $tstr = $tary[0];
    $tmpstr = str_replace(WDJA_CINFO, $tstr, $tmpstr);
    $tpl_nextpage = ii_ctemplate($tmpstr, '{@nextpage}');
    $tary = explode('{|}', $tpl_nextpage);
    if ($tstate2)
    {
      $tstr = $tary[1];
      if ($type == 'search') $tstr = str_replace('{$URLnext}', ii_iurl('searchpage', $turlid, $nurltype , 'urlkey=' . $toffset + $tpagesize), $tstr);
      else $tstr = str_replace('{$URLnext}', ii_iurl('listpage', $turlid, $nurltype , 'urlkey=' . $toffset + $tpagesize), $tstr);
    }
    else $tstr = $tary[0];
    $tmpstr = str_replace(WDJA_CINFO, $tstr, $tmpstr);
    $tpl_lastpage = ii_ctemplate($tmpstr, '{@lastpage}');
    $tary = explode('{|}', $tpl_lastpage);
    if ($tstate2)
    {
      $tlastoffset = $trslimit - (($trslimit - $toffset) % $tpagesize);
      if ($tlastoffset == $trslimit) $tlastoffset = $trslimit - $tpagesize;
      $tstr = $tary[1];
      if ($type == 'search') $tstr = str_replace('{$URLlast}', ii_iurl('searchpage', $turlid, $nurltype , 'urlkey=' . $tlastoffset), $tstr);
      else $tstr = str_replace('{$URLlast}', ii_iurl('listpage', $turlid, $nurltype , 'urlkey=' . $tlastoffset), $tstr);
    }
    else $tstr = $tary[0];
    $tmpstr = str_replace(WDJA_CINFO, $tstr, $tmpstr);
    $tmpstr = str_replace('{$npagenum}', $tnpagenum, $tmpstr);
    $tmpstr = str_replace('{$pagenums}', $tpagenums, $tmpstr);
    $tmpstr = str_replace('{$xpagenum}', $txpagenum, $tmpstr);
    $tmpstr = str_replace('{$pagesize}', $tpagesize, $tmpstr);
    if ($type == 'search') $tmpstr = str_replace('{$goURL}', ii_iurl('searchpage', $turlid, $nurltype , 'urlkey=\' + cc_cutepage(get_id(\'go-page-num\').value) + \''), $tmpstr);
    else $tmpstr = str_replace('{$goURL}', ii_iurl('listpage', $turlid, $nurltype , 'urlkey=\' + cc_cutepage(get_id(\'go-page-num\').value) + \''), $tmpstr);
    $tmpstr = ii_creplace($tmpstr);
    return $tmpstr;
  }

  function get_pagenum($type = 'list') 
  {
    global $nurltype;
    $maxlength = 10;
    $toffset = $this -> offset;
    $tpagesize = $this -> pagesize;
    $trslimit = $this -> rslimit;
    $turlid = $this -> urlid;
    $turlid = is_numeric($turlid) ? ii_get_num($turlid) : ii_cstr($turlid);
    if(ii_isnull($tpagesize) || $tpagesize == 0) $tpagesize = 20;
    $tpagenums = @ceil($trslimit / $tpagesize);
    $tnpagenum = @ceil($toffset / $tpagesize) + 1;
    if ($tnpagenum > $tpagenums) $tnpagenum = $tpagenums;
    $txpagenum = $tnpagenum + 1;
    if ($txpagenum > $tpagenums) $txpagenum = $tpagenums;
    $tstate1 = ($toffset > 0) ? 1 : 0;
    $tstate2 = (($toffset + $tpagesize) < $trslimit) ? 1 : 0;
    $tmpstr = '';
    if(ii_isadmin()) $nurltype = 0;
    if ($tpagenums >= 1)
    {
      $tmpstr = ii_itake('global.tpl_common.pagenum', 'tpl');
      $tmpastr = ii_ctemplate($tmpstr, '{@}');
      $tmprstr = '';
      for($ti = 0;$ti < $tpagenums; $ti++)
      {
        $tmptstr = $tmpastr;
        if ($type == 'list' && isset($_GET['keyword']) && !isset($_GET['classid'])) $tmptstr = str_replace('{$pageurl}', ii_iurl('searchpage', $turlid, $nurltype , 'urlkey=' . $ti*$tpagesize), $tmptstr);
        elseif ($type == 'tag') $tmptstr = str_replace('{$pageurl}', ii_iurl('tagpage', $turlid, $nurltype , 'cutekey=' . $ti*$tpagesize), $tmptstr);
        elseif ($type == 'detail') $tmptstr = str_replace('{$pageurl}', ii_iurl('cutepage', $turlid, $nurltype , 'cutekey=' . $ti*$tpagesize), $tmptstr);
        else $tmptstr = str_replace('{$pageurl}', ii_iurl('listpage', $turlid, $nurltype , 'urlkey=' . $ti*$tpagesize), $tmptstr);
        $tmptstr = str_replace('{$pagenum}', $ti + 1, $tmptstr);
        $tmptstr = $ti + 1 == $tnpagenum ?  str_replace('{$current}', ' class="current"', $tmptstr) : str_replace('{$current}', '', $tmptstr);
        if (($ti > $tpagenums - $maxlength - 1 || $ti > $tnpagenum - 6) && ($ti < $tnpagenum + $maxlength - 5 || $ti < $maxlength)) $tmprstr .= $tmptstr;
      }
      if ($tstate1)
      {
        if ($type == 'list' && isset($_GET['keyword']) && !isset($_GET['classid'])) $tmpstr = str_replace('{$pre}', '<a class="np-page" href="' . ii_iurl('searchpage', $turlid, $nurltype , 'urlkey=' . $toffset - $tpagesize) . '">' . ii_itake('global.lng_cutepage.prepage', 'lng') . '</a>', $tmpstr);
        elseif ($type == 'tag') $tmpstr = str_replace('{$pre}', '<a class="np-page" href="' . ii_iurl('tagpage', $turlid, $nurltype , 'cutekey=' . $toffset - $tpagesize) . '">' . ii_itake('global.lng_cutepage.prepage', 'lng') . '</a>', $tmpstr);
        elseif ($type == 'detail') $tmpstr = str_replace('{$pre}', '<a class="np-page" href="' . ii_iurl('cutepage', $turlid, $nurltype , 'cutekey=' . $toffset - $tpagesize) . '">' . ii_itake('global.lng_cutepage.prepage', 'lng') . '</a>', $tmpstr);
        else $tmpstr = str_replace('{$pre}', '<a class="np-page" href="' . ii_iurl('listpage', $turlid, $nurltype , 'urlkey=' . ($toffset - $tpagesize)) . '">' . ii_itake('global.lng_cutepage.prepage', 'lng') . '</a>', $tmpstr);
      }
      else $tmpstr = str_replace('{$pre}', '', $tmpstr);
      if ($tstate2)
      {
        if ($type == 'list' && isset($_GET['keyword']) && !isset($_GET['classid'])) $tmpstr = str_replace('{$next}', '<a class="np-page" href="' . ii_iurl('searchpage', $turlid, $nurltype , 'urlkey=' . $toffset + $tpagesize) . '">' . ii_itake('global.lng_cutepage.nextpage', 'lng') . '</a>', $tmpstr);
        else $tmpstr = str_replace('{$next}', '<a class="np-page" href="' . ii_iurl('listpage', $turlid, $nurltype , 'urlkey=' . ($toffset + $tpagesize)) . '">' . ii_itake('global.lng_cutepage.nextpage', 'lng') . '</a>', $tmpstr);
      }
      else $tmpstr = str_replace('{$next}', '', $tmpstr);
      $tmpstr = str_replace(WDJA_CINFO, $tmprstr, $tmpstr);
      $tmpstr = str_replace('{$npagenum}', $tnpagenum, $tmpstr);
      $tmpstr = str_replace('{$pagenums}', $tpagenums, $tmpstr);
      $tmpstr = str_replace('{$xpagenum}', $txpagenum, $tmpstr);
      $tmpstr = str_replace('{$pagesize}', $tpagesize, $tmpstr);
      $tmpstr = ii_creplace($tmpstr);
    }
    return $tmpstr;
  }

}

require('PHPMailer/Exception.php');
require('PHPMailer/PHPMailer.php');
require('PHPMailer/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class cc_socketmail
{
  public $server;
  public $port;
  public $username;
  public $password;
  public $from;
  public $to;
  public $subject;
  public $message;

  function send_mail()
  {
    $tserver = $this -> server;
    $tport = $this -> port;
    $tcharset = $this -> charset;
    $tusername = $this -> username;
    $tpassword = $this -> password;
    $tfrom = $this -> from;
    $tto = $this -> to;
    $tsubject = $this -> subject;
    $tmessage = $this -> message;

    if (empty($tsubject) || empty($tmessage)) {
      return array('result' => false, 'msg' => '????????????');
    }
    $fromAddress = $tfrom;
    $pwd =  $tpassword;
    $toAddress = $tto;

    $mail = new PHPMailer();
    //??????PHPMailer??????SMTP
    $mail->isSMTP();
    //??????SMTP??????
    // 0 =???????????????????????????
    // 1 =???????????????
    // 2 =???????????????????????????
    $mail->SMTPDebug = 0 ;
    //?????????????????????????????????
    $mail->Host = $tserver;
    //??????
    // $ mail-> Host = gethostbyname???'smtp.gmail.com'???;
    //???????????????????????????SMTP over IPv6
    //??????SMTP????????? -  587???????????????????????????TLS??????RFC4409 SMTP??????
    $mail->Port = $tport;
    //???????????????????????? -  ssl????????????????????????tls
    $mail->SMTPSecure = 'ssl';
    //????????????SMTP????????????
    $mail->SMTPAuth = true ;
    //??????SMTP???????????????????????? - ??????gmail???????????????????????????
    $mail->Username = $fromAddress;
    //??????SMTP?????????????????????(?????????????????????????????????)
    $mail->Password = $pwd;
    //?????????????????????????????? ??????GB2312 ?????????utf-8 ??????utf8????????????????????????????????????
    $mail->CharSet = $tcharset;
    //????????????????????????????????????
    $mail->setFrom($fromAddress,$tusername);
    //????????????????????????
    //$mail->addReplyTo('***@qq.com','??????');
    //??????????????????????????????
    $mail->addAddress($toAddress,$toAddress);
    //???????????????
    $mail->Subject = $tsubject;
    //????????????????????????HTML?????????????????????????????????????????????????????????
    //???HTML???????????????????????????????????????
    //$mail->msgHTML(file_get_contents(' contents.html '),__DIR__);
    //???????????????????????????????????????
    $mail->AltBody  = 'This is the body in plain text for non-HTML mail clients';
    $mail->Body  = $tmessage;
    $result = $mail->send();
  }
}

//****************************************************
// WDJA CMS Power by wdja.net
// Email: admin@wdja.net
// Web: http://www.wdja.net/
//****************************************************
?>