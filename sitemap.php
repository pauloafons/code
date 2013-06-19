<?php

$siteMapType="google";
$startUrls="http://www.exemplo.com.br/";
$incUrls=".htm,.php,.html";
$excUrls="PHPSESS";
$depthNum="1";
$limitNum="1000";
$delaySec="0.1";
$urlLastMod="true";
$urlSort="true";
$urlTitle="false";
$urlDesc="false";
$urlUrl="false";
$urlCount="false";
$htmlFull="true";
$htmlTitleTag="p";
$htmlDescTag="p";
$urlVals="";
$priVals="";
$freqVals="";
$priDef="0.5";
$freqDef="weekly";


error_reporting(E_ERROR);
$dynamicSiteMap='true';
$lastModName='Last-Modified:';
$titleTag='title';
$descTag='description';
$genGStart='<?xml version="1.0" encoding="UTF-8"?>';
$genGStart.='<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" ';
$genGStart.='xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ';
$genGStart.='xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 ';
$genGStart.='http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">';
$genGEnd='</urlset>';
$genSMPStart='<?xml version="1.0" encoding="UTF-8"?>';
$genSMPStart.='<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ';
$genSMPStart.='xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 ';
$genSMPStart.='http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" ';
$genSMPStart.='xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$genSMPEnd='</urlset>';
$genRStart='<?xml version="1.0" encoding="UTF-8"?>';
$genRStart.='<rss version="2.0"><channel>';
$genREnd="</channel></rss>";
$genHStart='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">';
$genHEnd='</body></html>';
$generator="SiteMap XML";
$genOut='';
$hostDom='';
$limitCnt=0;
$linkCnt=0;
$depthCnt=0;
$useUrls=array();
$curUrls=array();
$useeol='\n';
$nowTime = gmdate('D, d M Y H:i:s O');
$regst="1217975118";
$softid="smxp";
$evaldays="7";
$useEncDec="jpQJBMJJ9A";
$varTextAreas=array('startUrls','incUrls','excUrls','urlVals','priVals','freqVals');
foreach($varTextAreas as $varTextArea){$vals=explode(',',$$varTextArea);
$$varTextArea=array_map('trim',$vals);
}

smRun();
siteMapOut();

function codeXOR($codeCh){
	global $useEncDec;
	$codeUse = 0;
	$chAll = '';
	$codeChLen=strlen($codeCh);
	for ($chUsePos=0;$chUsePos < $codeChLen;$chUsePos++){
		$chUse = ord($codeCh[$chUsePos]);
		$chEnDe = $chUse^ord($useEncDec[$codeUse]);
		$chAll .= chr($chEnDe);
		$codeUse=($codeUse+1)%strlen($useEncDec);
	}
	return $chAll;
}

function smRun(){
	global $genOut;
	global $hostDom;
	global $limitCnt;
	global $linkCnt;
	global $depthCnt;
	global $depthNum;
	global $limitNum;
	global $siteMapType;
	global $startUrls;
	global $startUrlsFir;
	global $genGStart;
	global $genGEnd;
	global $genSMPStart;
	global $genSMPEnd;
	global $debug;
	set_time_limit ( 600 );
	$depthCnt=0;
	$limitCnt=0;
	$linkCnt=0;
	$useUrls=array();
	$curUrls=array();
	$genOut='';
	$hostDom='';
	for($depthCnt=0;$depthCnt<=$depthNum;$depthCnt++){
		if($limitCnt<=$limitNum){
			getLinks();
		}
	}
	if($siteMapType=='google'){
		genGXml();
	}elseif($siteMapType=='rss'){
		genRss();
	}elseif($siteMapType=='html'){
		genHtml();
	}elseif($siteMapType=='text'){
		genTxt();
	}elseif($siteMapType=='sitemapsprotocol'){
		$genGStart=$genSMPStart;
		$genGEnd=$genSMPEnd;
		genGXml();
	}
	$depthCnt--;
	$startUrls=$startUrlsFir;
}

function getLinks(){
	global $startUrls;
	global $incUrls;
	global $excUrls;
	global $depthNum;
	global $depthCnt;
	global $limitNum;
	global $useUrls;
	global $curUrls;
	global $limitCnt;
	global $delaySec;
	global $startUrlsFir;
	global $hostDom;
	global $linkCnt;
	global $dynamicSiteMap;
	global $debug;
	$fileSt="http://";
	$fileStLen=strlen($fileSt);
	$fileWWW="www.";
	$fileWWWLen=strlen($fileWWW);
	if($depthCnt>0){
		$startUrls=$curUrls;
		$curUrls=array();
	}else{
		$startUrlsFir=$startUrls;
	}
	foreach($startUrls as $startUrl){
		if(empty($hostDom)){
			$urlParts=parse_url($startUrl);
			if(!empty($urlParts['scheme'])){
				$fileSt = $urlParts['scheme'];
				$fileSt="$fileSt://";
				$fileStLen=strlen($fileSt);
			}
			if (substr($startUrl,0,$fileStLen) != $fileSt){
				$startUrl=$fileSt.$startUrl;
			}
			$urlParts=parse_url($startUrl);
			$hostDom = $urlParts['host'];
			$hostDom = strtolower($hostDom);
		}
		$urlParts=parse_url($startUrl);
		if(!empty($urlParts['host'])){
			$hostUrl=$urlParts['host'];
			$hostUrl=strtolower($hostUrl);
		}else{
			$hostUrl=$hostDom;
		}
		if($dynamicSiteMap!='true'){
			echo"disMess('Site Domain $hostDom');";
		}
		if($hostUrl==$hostDom){
			if($delaySec>0){
				usleep($delaySec*1000000);
			}
			$useHtml=@file_get_contents($startUrl);
			if($useHtml===false){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $startUrl);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$useHtml=curl_exec($ch);
				if($useHtml===false){
					echo"<p><br /><br /><span style='color:red;font-weight: bold;'>Error</span> - Unable to retrieve file contents. If this problem persists you may have a <b>coding error in the page $startUrl</b> and should <a href='http://validator.w3.org/check?uri=$startUrl'>check the code validity of $startUrl</a> or your <b>server may not support file_get_contents or curl</b> and is unable to read url contents in this case you need to contact your server host.</p>";
					curl_close($ch);
					exit;
				}
				curl_close($ch);
			}
			$preLinkParts=parse_url($startUrl);
			if(!empty($preLinkParts['path'])){
				$prePath=$preLinkParts['path'];
				$preDir=dirname($prePath);
				if($preDir=='.'||$preDir=='/'||$preDir=='//'){
					$preDir='/';
				}else{
					$preDir=$preDir.'/';
				}
			}else{
				$preDir='/';
			}
			$pattern='`href=[\"\']([^>\'\"\s\t\n\r]+)[\"\']`i';
			preg_match_all($pattern,$useHtml,$matchUrls);
			$uniUrls=array_unique($matchUrls[1]);
			$limitCnt=$limitCnt+count($uniUrls);
			$addUrls=array($startUrl);
			$linkUrls=array_merge($addUrls,$uniUrls);
			foreach($linkUrls as $linkUrl){
				$linkUrl=utfEncode($linkUrl);
				$fragLen=strpos($linkUrl,'#');
				if($fragLen!==false){
					$linkUrl=substr($linkUrl,0,$fragLen);
				}
				$trimUrl=strtolower($linkUrl);
				if (substr($trimUrl,0,$fileStLen) == $fileSt){
					$trimUrl=substr($trimUrl, $fileStLen);
				}
				if(substr($trimUrl,-1) == "/"){
					$trimUrl=substr($trimUrl, 0, -1);
					$trimUrl=trim($trimUrl);
					if(empty($trimUrl)){
						$trimUrl=$hostDom;
					}
				}
				$incMk=false;
				if($trimUrl==$hostDom){
					$incMk=true;
					$excMk=false;
					$linkUrl=$fileSt.$hostUrl.'/';
				}else{
					foreach($incUrls as $incUrl){
						if(!empty($incUrl)){
							$incCk=strpos($linkUrl,$incUrl);
						}else{
							$incCk=false;
						}
						if($incCk!==false){
							$incMk=true;
							break;
						}
					}
					$excMk=false;
					foreach($excUrls as $excUrl){
						if(!empty($excUrl)){
							$excCk=strpos($linkUrl,$excUrl);
						}else{
							$excCk=false;
						}
						if($excCk!==false){
							$excMk=true;
							break;
						}
					}
				}
				if($incMk===true&&$excMk===false){
					$linkParts=parse_url($linkUrl);
					if(!empty($linkParts['host'])){
						$hostLink=$linkParts['host'];
						$hostLink=strtolower($hostLink);
						if($hostLink==$hostDom){
							$useUrls[]=$linkUrl;
							$curUrls[]=$linkUrl;
						}
					}elseif(strpos($linkUrl,"../")!==false){
						$pattern = '/';
						$curDirs = explode($pattern,$startUrl);
						$curDirs = array_reverse($curDirs);
						if(substr($startUrl,-1) != "/"){
							unset($curDirs[0]);
						}
						$relDirs = explode($pattern,$linkUrl);
						$relDirs = array_reverse($relDirs);
						$upDir=count($relDirs);
						$absDirs=array();
						$curLev=1;
						for ($dirLev=0;$dirLev<$upDir;$dirLev++){
							if($relDirs[$dirLev]!='..'){
								$absDirs[]=$relDirs[$dirLev];
							}else{
								unset($curDirs[$curLev]);
								$curLev++;
							}
						}
						$pattern = '/';
						$absDirs = array_reverse($absDirs);
						$absDir=implode($pattern,$absDirs);
						$curDirs = array_reverse($curDirs);
						$curDir=implode($pattern,$curDirs);
						$linkUrl=$fileSt.$hostDom.'/'.$absDir;
						$useUrls[]=$linkUrl;
						$curUrls[]=$linkUrl;
					}elseif(strpos($linkUrl,"/")!==0){
						$linkUrl=$fileSt.$hostDom.$preDir.$linkUrl;
						$useUrls[]=$linkUrl;
						$curUrls[]=$linkUrl;
					}else{
						if(substr($linkUrl,0,1)!='/'){
							$linkUrl='/'.$linkUrl;
						}
						$linkUrl=$fileSt.$hostUrl.$linkUrl;
						$useUrls[]=$linkUrl;
						$curUrls[]=$linkUrl;
					}
					if($dynamicSiteMap!='true'){
						echo"disMess('Processing $linkUrl');";
					}
				}
			}
		}
	}
	$useUrls=array_unique($useUrls);
	$linkCnt=count($useUrls);
}
function genGXml(){
	global $useUrls;
	global $urlVals;
	global $priVals;
	global $freqVals;
	global $priDef;
	global $freqDef;
	global $genOut;
	global $urlSort;
	global $urlLastMod;
	global $genGStart;
	global $genGEnd;
	if(!empty($urlSort)&&$urlSort!='false'){
		sort($useUrls);
	}
	foreach($useUrls as $linkUrl){
		$priUse=$priDef;
		$freqUse=$freqDef;
		$arrPos=0;
		foreach($urlVals as $urlVal){
			if(!empty($urlVal)&&$urlVal!='false'){
				$urlCk=strpos($linkUrl,$urlVal);
			}else{
				$urlCk=false;
			}
			if($urlCk!==false){
				$priUse=$priVals[$arrPos];
				$freqUse=$freqVals[$arrPos];
				break;
			}
			$arrPos++;
		}
		$genOut.=" <url><loc>$linkUrl</loc>";
		if(!empty($urlLastMod)&&$urlLastMod!='false'){
			http($linkUrl);
		}
		$genOut.="<priority>$priUse</priority><changefreq>$freqUse</changefreq></url>";
	}
	$genOut=$genGStart.$genOut.$genGEnd;
}
function genRss(){
	global $useUrls;
	global $hostDom;
	global $genOut;
	global $urlTitle;
	global $urlDesc;
	global $urlLastMod;
	global $urlSort;
	global $generator;
	global $genRStart;
	global $genREnd;
	$rssTime = gmdate('D, d M Y H:i:s O');
	$genRStart.="<title>Site Map $hostDom</title>";
	$genRStart.="<link>$hostDom</link>";
	$genRStart.="<description>Site Map for the domain $hostDom</description>";
	$genRStart.="<lastBuildDate>$rssTime</lastBuildDate>";
	$genRStart.="<generator>$generator</generator>";
	if(!empty($urlSort)&&$urlSort!='false'){
		sort($useUrls);
	}
	foreach($useUrls as $linkUrl){
		if((!empty($urlTitle)&&$urlTitle!='false')||(!empty($urlDesc)&&$urlDesc!='false')||(!empty($urlLastMod)&&$urLastMod!='false')){
			http($linkUrl);
		}else{
			$genOut.="<item>";
			$genOut.="<link>$linkUrl</link>";
			$genOut.="</item>";
		}
	}
	$genOut=$genRStart.$genOut.$genREnd;
}
function genHtml(){
	global $useUrls;
	global $genOut;
	global $linkCnt;
	global $hostDom;
	global $urlTitle;
	global $urlDesc;
	global $urlLastMod;
	global $urlCount;
	global $urlSort;
	global $titleTag;
	global $htmlTitleTag;
	global $htmlFull;
	global $urlNum;
	global $genHStart;
	global $genHEnd;
	$genHStart.="<head><title>Site Map $hostDom</title></head><body>";
	if(!empty($urlSort)&&$urlSort!='false'){
		sort($useUrls);
	}
	$urlNum=0;
	foreach($useUrls as $linkUrl){
		if(!empty($urlCount)&&$urlCount!='false'){
			$urlNum++;
		}
		if((!empty($urlTitle)&&$urlTitle!='false')||(!empty($urlDesc)&&$urlDesc!='false')||(!empty($urlLastMod)&&$urlLastMod!='false')){
			http($linkUrl);
		}else{
			$genOut.='<'.$htmlTitleTag.' class="sm'.$titleTag.'">';
			if($urlNum>0){
				$genOut.=$urlNum.'. ';
			}
			$genOut.='<a href="'.$linkUrl.'">'.$linkUrl.'</a>';
			$genOut.='</'.$htmlTitleTag.'>';
		}
	}
	if(!empty($htmlFull)&&$htmlFull!='false'){
		$genOut=$genHStart.$genOut.$genHEnd;
	}
}
function genTxt(){
	global $useUrls;
	global $genOut;
	global $urlSort;
	global $useeol;
	global $urlTitle;
	global $urlDesc;
	global $urlLastMod;
	if(!empty($urlSort)&&$urlSort!='false'){
		sort($useUrls);
	}
	foreach($useUrls as $linkUrl){
		if((!empty($urlTitle)&&$urlTitle!='false')||(!empty($urlDesc)&&$urlDesc!='false')||(!empty($urlLastMod)&&$urlLastMod!='false')){
			http($linkUrl);
		}else{
			$genOut.=$linkUrl.$useeol;
		}
	}
}
function http($useUrl){
	global $genOut;
	global $urlTitle;
	global $urlDesc;
	global $urlLastMod;
	global $urlUrl;
	global $urlNum;
	global $htmlTitleTag;
	global $htmlDescTag;
	global $siteMapType;
	global $lastModName;
	global $lastMod;
	global $titleTag;
	global $descTag;
	global $generator;
	global $nowTime;
	global $useeol;
	$title='No Title';
	$desc='No Description';
	if($siteMapType=='google'||$siteMapType=='sitemapsprotocol'||((empty($urlTitle)||$urlTitle=='false')&&(empty($urlDesc)||$urlDesc=='false'))){
		$useReq='HEAD';
	}else{
		$useReq='GET';
	}
	$urlParts=parse_url($useUrl);
	if($urlParts!==false){
		$useHost=$urlParts['host'];
		$usePath=$urlParts['path'];
		if(empty($usePath)){
			$usePath='/';
		}
		$header="$useReq $usePath HTTP/1.1 \r\n";
		$header.="Host: $useHost \r\n";
		$header.="User-Agent: $generator \r\n";
		$header.="Connection: Close \r\n\r\n";
		$fp = fsockopen($useHost,80,$errno,$errstr,30);
		if (!$fp){
			$debug.="<p><span class='err'>Connection Fail:</span> Unable to connect to $useUrl</p>";
		}else{
			$lastMod='';
			$res='';
			fputs ($fp, $header);
			while (!feof($fp)){
				$resLine=fgets($fp, 1024);
				$res.=$resLine;
				if((!empty($urlLastMod)&&$urlLastMod!='false')&&strpos($resLine,$lastModName)!==false&&empty($lastMod)){
					$lastModNameLen=strlen($lastModName);
					$lastMod=trim(substr($resLine,$lastModNameLen));
				}
			}
			fclose ($fp);
		}
		if(empty($lastMod)){
			$lastMod=$nowTime;
		}
		if((!empty($urlTitle)&&$urlTitle!='false')&&!empty($res)){
			$matchGets==array();
			$pattern="`<\s*".$titleTag."\s*>([^<]+)<\/\s*".$titleTag."\s*>`i";
			preg_match($pattern,$res,$matchGets);
			if(!empty($matchGets[1])){
				$title=$matchGets[1];
				$title=strClean($title);
				$title=utfEncode($title);
			}
		}
		if((!empty($urlDesc)&&$urlDesc!='false')&&!empty($res)){
			$matchGets==array();
			$pattern="`name\s*=\s*[\"\']?\s*".$descTag."\s*[\"\']?\s*content\s*=\s*[\"\']([^>\'\"]+)[\"\']`i";
			preg_match($pattern,$res,$matchGets);
			if(!empty($matchGets[1])){
				$desc=$matchGets[1];
				$desc=strClean($desc);
				$desc=utfEncode($desc);
			}
		}
		if($siteMapType=='google'||$siteMapType=='sitemapsprotocol'){
			$lastModTS=strtotime($lastMod);
			if(!empty($lastModTS)){$genOut.='<lastmod>'.gmdate("Y-m-d\TH:i:s+00:00",$lastModTS).'</lastmod>';
			}
		}elseif($siteMapType=='rss'){
			$genOut.="<item>";
			if(!empty($title)&&(!empty($urlTitle)&&$urlTitle!='false')){
				$genOut.="<title>$title</title>";
			}
			$genOut.="<link>$useUrl</link>";
			if(!empty($desc)&&(!empty($urlDesc)&&$urlDesc!='false')){
				$genOut.="<description>$desc</description>";
			}
			if(!empty($lastMod)&&(!empty($urlLastMod)&&$urlLastMod!='false')){
				$genOut.="<pubDate>$lastMod</pubDate>";
			}
			$genOut.="</item>";
		}elseif($siteMapType=='html'){
			$genOut.='<'.$htmlTitleTag.' class="sm'.$titleTag.'">';
			if($urlNum>0){
				$genOut.=$urlNum.'. ';
			}
			if(empty($title)||$title=='No Title'){
				$title=$useUrl;
			}
			$genOut.='<a href="'.$useUrl.'">'.$title.'</a>';
			if(!empty($lastMod)&&(!empty($urlLastMod)&&$urlLastMod!='false')){
				$genOut.='<br />'.$lastMod;
			}
			if($title!=$useUrl&&(!empty($urlUrl)&&$urlUrl!='false')){
				$genOut.='<br />'.$useUrl;
			}
			$genOut.='</'.$htmlTitleTag.'>';
			if(!empty($desc)&&(!empty($urlDesc)&&$urlDesc!='false')){
				$genOut.='<'.$htmlDescTag.' class="sm'.$descTag.'">'.$desc.'</'.$htmlDescTag.'>';
			}
		}elseif($siteMapType=='text'){
			if(!empty($title)&&(!empty($urlTitle)&&$urlTitle!='false')){
			$genOut.=$title.$useeol;
			}
			$genOut.=$useUrl.$useeol;
			if(!empty($lastMod)&&(!empty($urlLastMod)&&$urlLastMod!='false')){
				$genOut.=$lastMod.$useeol;
			}
			if(!empty($desc)&&(!empty($urlDesc)&&$urlDesc!='false')){
				$genOut.=$desc.$useeol;
			}
		}
	}else{
		$debug.="<p><span class='err'>Error:</span> Could not $useReq $useUrl</p>";
	}
}
function strClean($strCleaned){
	$strCleaned=trim($strCleaned);
	$strCleaned=preg_replace('`(\r\n|\n|\r)`',' ',$strCleaned);
	$strCleaned=preg_replace('`\s\s+`',' ',$strCleaned);
	$strCleaned=trim($strCleaned);
	return $strCleaned;
}
function utfEncode($utfEncoded){
	if(function_exists('html_entity_decode')&&function_exists('htmlentities')){
		$utfEncoded=html_entity_decode($utfEncoded,ENT_QUOTES);
		$utfEncoded=htmlentities($utfEncoded,ENT_QUOTES);
	}
	if(extension_loaded('xml')&&function_exists('utf8_encode')){
		$utfEncoded=utf8_encode($utfEncoded);
	}
	return $utfEncoded;
}
function siteMapOut(){
	global $siteMapType;
	global $genOut;
	if(!empty($siteMapType)){
		if($siteMapType=='google'||$siteMapType=='rss'||$siteMapType=='sitemapsprotocol'){
			header('Content-type: text/xml');
		}elseif($siteMapType=='html'){
			header('Content-type: text/html');
		}elseif($siteMapType=='text'){
			header('Content-type: text/plain');
		}
		#echo str_replace("index.php","",$genOut);
		echo $genOut;
	}
}?>