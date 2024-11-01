<?php 

$type = $instance['type'];
$aa_sel = $type == "aa" ? 'selected' : '';
$fav_sel = $type == "fav" ? 'selected' : '';

$showDate = $instance["showDate"];
$show_date_no = $showDate == 0 ? 'checked' : '';
$show_date_yes = $showDate == 1 ? 'checked' : '';

$dateFormat = $instance["dateFormat"];
$ymd_sel = $dateFormat == "y-m-d" ? 'selected' : '';
$dmy_sel = $dateFormat == "d/m/y" ? 'selected' : '';
$mdy_sel = $dateFormat == "m/d/y" ? 'selected' : '';
$dmy2_sel = $dateFormat == "d.m.y" ? 'selected' : '';
?>

<p>
<b>పేరు:</b><br />
<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

  <p>
  <b>రకము :</b><br />
<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
  <option value="fav" <?php echo $fav_sel; ?>>నా ఇష్టమైనది (యాదృచ్ఛిక)</option>
  <option value="aa" <?php echo $aa_sel; ?>>telugubibleonline.com నుండి </option>
  </select>
  </p>

<p>
<strong>పేరులో తేదీ చూపించాలా?</strong>
<input type=radio name="<?php echo $this->get_field_name( 'showDate' ); ?>" value="1" <?php echo $show_date_yes; ?> /> అవును 
<input type=radio name="<?php echo $this->get_field_name( 'showDate' ); ?>" value="0" <?php echo $show_date_no; ?> /> కాదు 
<br /><em>ఇది ఈరోజు తేదీని ఈ విడ్జెట్ పేరు చివర జతపరుస్తుంది</em>
</p>


<p>
<strong>తేదీ ఫార్మాట్:</strong>
<select id="<?php echo $this->get_field_id( 'dateFormat' ); ?>" name="<?php echo $this->get_field_name( 'dateFormat' ); ?>">
  <option value="y-m-d" <?php echo $ymd_sel; ?>>2013-07-29</option>
  <option value="d/m/y" <?php echo $dmy_sel; ?>>29/07/2013</option>
  <option value="d.m.y" <?php echo $dmy2_sel; ?>>29.07.2013</option>
</select>
<br /><em>తేదీ చూపించు అవును అయితేనే ఇది వర్తిస్తుంది.</em>
</p>