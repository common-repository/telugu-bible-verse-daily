<div class="wrap">
<h1>తెలుగు బైబిల్ వచనములు </h1>

<h3>వినియోగించుటకు సూచనలు</h3>
<ol>

<li>మీ పేజీ లో గాని పోస్ట్ లో గాని బైబిల్ వచనము రావాలంటే, [telugu-verse-display] ట్యాగ్ వాడండి :
</li>


<?php
$version = get_option("tvd_post_version");

$type = get_option("tvd_post_type");
$aa_sel = $type == "aa" ? 'selected' : '';
$fav_sel = $type == "fav" ? 'selected' : '';

$cxn = get_option("tvd_connection");
$fopen_sel = $cxn == "fopen" ? 'checked=checked' : '';
$curl_sel = $cxn == "curl" ? 'checked=checked' : '';


?>
	
<form method="post" name="options" target="_self">

<table>

<tr><td colspan="2"><h4>Default settings</h4></td></tr>

<tr>
<td><strong>వచనము ఎంచుకొను</strong></td> 

<td>
<select name="tvd_post_type">
  <option value="fav" <?php echo $fav_sel; ?>>నా ఇష్టమైనది (యాదృచ్ఛిక)</option>
  <option value="aa" <?php echo $aa_sel; ?>>telugubibleonline.com నుండి</option>
  </select>
</td>
</tr>

<tr>
<td><strong>Connection</strong></td>
<td>
<input type="radio" name="tvd_connection" value="fopen" <?php echo $fopen_sel; ?> /> fopen
<input type="radio" name="tvd_connection" value="curl" <?php echo $curl_sel; ?> /> curl
</td>
</tr>

</table>

  <p class="submit">
    <input type="submit" name="tvd_update" class="button-primary" value="Update Options &raquo;" />
  </p>

<hr />

<table width="50%">
<tr><td><strong>ఇష్టమైన వచనములు జోడించు</strong></td></tr>
<tr>
<td>
<label name="book">గ్రంధము</label>
</td>
<td>
<label name="chapter">అధ్యాయము</label>
</td>
<td>
<label name="verse">వచనము</label>
</td>
</tr>
<tr>
<td>
<select name="books_id">
<option value="ఆదికాండము" >ఆదికాండము</option>
<option value="నిర్గమకాండము" >నిర్గమకాండము</option>
<option value="లేవీయకాండము" >లేవీయకాండము</option>
<option value="సంఖ్యాకాండము" >సంఖ్యాకాండము</option>
<option value="ద్వితీయోపదేశకాండము" >ద్వితీయోపదేశకాండము </option>
<option value="యెహొషువ" >యెహొషువ</option>
<option value="న్యాయాధిపతులు" >న్యాయాధిపతులు </option>
<option value="రూతు" >రూతు</option>
<option value="1 సమూయేలు" >1 సమూయేలు</option>
<option value="2 సమూయేలు" >2 సమూయేలు</option>
<option value="1 రాజులు" >1 రాజులు </option>
<option value="2 రాజులు" >2 రాజులు </option>
<option value="1 దినవృత్తాంతములు" >1 దినవృత్తాంతములు</option>
<option value="2 దినవృత్తాంతములు" >2 దినవృత్తాంతములు</option>
<option value="ఎజ్రా" >ఎజ్రా </option>
<option value="నెహెమ్యా" >నెహెమ్యా</option>
<option value="ఎస్తేరు" >ఎస్తేరు </option>
<option value="యోబు" >యోబు</option>
<option value="కీర్తనలు" >కీర్తనలు</option>
<option value="సామెతలు" >సామెతలు</option>
<option value="ప్రసంగి" >ప్రసంగి</option>
<option value="పరమగీతము" >పరమగీతము</option>
<option value="యెషయా" >యెషయా</option>
<option value="యిర్మీయా" >యిర్మీయా</option>
<option value="విలాపవాక్యములు" >విలాపవాక్యములు</option>
<option value="యెహెజ్కేలు" >యెహెజ్కేలు</option>
<option value="దానియేలు" >దానియేలు</option>
<option value="హోషేయ" >హోషేయ</option>
<option value="యోవేలు" >యోవేలు</option>
<option value="ఆమోసు" >ఆమోసు</option>
<option value="ఓబద్యా" >ఓబద్యా</option>
<option value="యోనా" >యోనా</option>
<option value="మీకా" >మీకా</option>
<option value="నహూము" >నహూము</option>
<option value="హబక్కూకు" >హబక్కూకు</option>
<option value="జెఫన్యా" >జెఫన్యా</option>
<option value="హగ్గయి" >హగ్గయి</option>
<option value="జెకర్యా" >జెకర్యా</option>
<option value="మలాకీ" >మలాకీ</option>
<option value="మత్తయి" >మత్తయి</option>
<option value="మార్కు" >మార్కు</option>
<option value="లూకా" >లూకా</option>
<option value="యోహాను" >యోహాను</option>
<option value="అపొస్తలుల కార్యములు" >అపొస్తలుల కార్యములు</option>
<option value="రోమీయులకు" >రోమీయులకు</option>
<option value="1 కొరింథీయులకు" >1 కొరింథీయులకు</option>
<option value="2 కొరింథీయులకు" >2 కొరింథీయులకు</option>
<option value="గలతీయులకు" >గలతీయులకు</option>
<option value="ఎఫెసీయులకు" >ఎఫెసీయులకు</option>
<option value="ఫిలిప్పీయులకు" >ఫిలిప్పీయులకు</option>
<option value="కొలొస్సయులకు" >కొలొస్సయులకు</option>
<option value="1 థెస్సలొనీకయులకు" >1 థెస్సలొనీకయులకు</option>
<option value="2 థెస్సలొనీకయులకు" >2 థెస్సలొనీకయులకు</option>
<option value="1 తిమోతికి" >1 తిమోతికి</option>
<option value="2 తిమోతికి" >2 తిమోతికి</option>
<option value="తీతుకు" >తీతుకు</option>
<option value="ఫిలేమోనుకు" >ఫిలేమోనుకు</option>
<option value="హెబ్రీయులకు" >హెబ్రీయులకు</option>
<option value="యాకోబు" >యాకోబు</option>
<option value="1 పేతురు" >1 పేతురు</option>
<option value="2 పేతురు" >2 పేతురు</option>
<option value="1 యోహాను" >1 యోహాను</option>
<option value="2 యోహాను" >2 యోహాను</option>
<option value="3 యోహాను" >3 యోహాను</option>
<option value="యూదా" >యూదా</option>
<option value="ప్రకటన" >ప్రకటన</option>
</select>
</td>
<td>
<input type="text" name="chapter">
</td>
<td>
<input type="text" name="verse">
</td>
<td>
<input type="submit" name="verse_add" class="button-primary" value="Add Verse &raquo;" />
</td>
</tr>
</table>
<hr />
<table width="100%" >
<tr><td><strong>ఇప్పటి ఇష్టమైన వచనములు </strong></td></tr>
<?php
echo "<tr>\r\n";
foreach ($favorites as $key => $fav) {  
  echo '<td><input type="submit" alt="Delete '.$fav.'" title="Delete '.$fav.'" name="tvd_delete_'.$key.'" class="button-primary" value="X" /> ';
  echo '<a href="javascript:void();" class="tvdtooltip">'.$fav.'</a></td>'."\r\n";
  
  if (($key % 3) == 2) echo "</tr>\r\n<tr>\r\n";
} 
?>
</table>

</form>

  </div>