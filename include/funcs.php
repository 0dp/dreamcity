<?php

function create_pdf($campdata) {

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator('Dreamcity');
    $pdf->SetAuthor('Dreamcity');
    $pdf->SetTitle('TCPDF Example 001');

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 14, '', true);

    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

// Set some content to print
    $html = 
"<h1>Dear Dreamer</h1>
<i>Here is a Copy of your previous application</i>
<p></p>" . "<br/>" .
$campdata->camp_description . "<br/>" .
$campdata->camp_short_desc . "<br/>" .
$campdata->camp_construction . "<br/>" .
$campdata->camp_participants . "<br/>" .
$campdata->camp_registration_date;


// Print text using writeHTMLCell()
     $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



// Close and output PDF document
// This method has several options, check the source code documentation for more information.
    //$data = $pdf->Output('application.pdf', 'E');

    $data = $pdf->Output('application.pdf', 'S');
    
    //$data = array($fileatt);

    //$data = chunk_split($fileatt);
/*
    //$fileatt = "./test.pdf";

    $fileatttype = "application/pdf";
    $fileattname = "newname.pdf";

    $file = fopen($fileatt, 'rb');
    $data = fread($file, filesize($fileatt));

    fclose($file);
*/
    return $data;
}


function dc_email_header() {
        
        $admin_email = 'noreply@' . $_SERVER['SERVER_NAME'];
        
        $from_name = "Dream City";

        $headers = array(
            "From: \"{$from_name}\" <{$admin_email}>\n",
            "Content-Type: text/plain; charset=\"" . get_option( 'blog_charset' ) . "\"\n",
        );

        //$headers = apply_filters( 'new_dreamcity_email_header', $headers );

        return $headers;
    }

function dc_emailExists($stremail){
    

    return false;
}

function dc_phoneExists($strPhone){
    
    return false;
}

//Completely sanitizes text
function sanitize($str)
{
    return strtolower(strip_tags(trim(($str))));
}

//Completely sanitizes text
function sanitizeKeepNewline($str)
{
    return strtolower(strip_tags(trim($str, "\n\r")));
}


function dc_camp_update_notes($campid, $notes, $append = false )
{

    global $wpdb;
    $Ok = true;

    $new_notes = $notes;

    $table_name = $wpdb->prefix . 'dc_camp';

    if( $append )
    {
        $new_notes = $wpdb->get_var( $wpdb->prepare( "SELECT camp_notes FROM $table_name WHERE camp_id = %d", $campid) );

        if( $new_notes != NULL ){
            $new_notes = $new_notes. "\n" . $notes;
        }else{
            $new_notes = $notes;
        }
    }

    $result = $wpdb->update( 
        $table_name, 
        array(                          
            'camp_notes' => $new_notes
        ), 
        array( 'camp_id' => $campid ),
        array( '%s' ),
        array( '%d' )
    );

    if( $result == false){
        $Ok = false;

    }

    return $Ok;
}

?>
