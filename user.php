<?php
  require 'db_conf.inc.php';
  /**
   * User Object class
   * holds data related to user
   */
  class User
  {
    //constructor used for creating object always needs array to work
    public function __construct($data)
    {
      $this->uuid         = mysqli_real_escape_string($data['UUID']);
      $this->u_mail       = $this->setMail($data['mail']);
      $this->displayName  = mysqli_real_escape_string($data['name']);
      $this->handle       = $this->creHandle($data['name']);
      $this->bg           = mysqli_real_escape_string($data['bg']);
      $this->fbuname      = mysqli_real_escape_string($data['fbuname']);
      $this->insta        = mysqli_real_escape_string($data['insta']);
      $this->scuname      = mysqli_real_escape_string($data['scuname']);
      $this->sccode       = mysqli_real_escape_string($data['sccode']);
      $this->twhandle     = mysqli_real_escape_string($data['twhandle'] || $data['twitterhandle']);
      if ($data['twhandle'] == null) $this->twhandle = mysqli_real_escape_string($data['twitterhandle']);
      $this->tumbuname    = mysqli_real_escape_string($data['tumbuname']);
      $this->perid        = mysqli_real_escape_string($data['perid']);
      $this->meerkat      = mysqli_real_escape_string($data['meerkat']);
      $this->tagline      = mysqli_real_escape_string($data['tagline']);
      $this->website      = mysqli_real_escape_string($data['website']);
    }
    public static function create()
    {
      $instance = new self();
      return $instance;
    }


    function creHandle($value) // creates user handle based on RealName.
    {
      $handle = strtolower($value);
      $handle = str_replace(' ', '_', $handle);
      return mysqli_real_escape_string($handle);
    }

    function setMail($mail)
    {
      if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return mysqli_real_escape_string($mail);
      }
      else {
        return "error";
      }
    }

    function setFB($username)
    {

    }

    public function writeDB()
    {
      $con  = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
      $con->set_charset('utf8');
    	if ($con->connect_errno) {
        echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
      }

      $sql  = "INSERT INTO user".
              "(UUID,realname,handle,mail,bg,fbuname,insta,snap,sncode,twitterhandle,peris,meerkatid,tumblr,website,tagline1,tagline2,join_date)".
              "VALUES('".(int)$this->uuid."','$this->displayName','$this->handle','$this->mail','$this->bg','$this->fbuname','$this->insta','$this->scuname','$this->sccode','$this->twhandle','$this->perid','$this->meerkatid','$this->tumbuname','$this->website','$this->tagline[0]','$this->tagline[1]',NOW())".
              "ON DUPLICATE KEY UPDATE
                realname = '$this->displayName',
                handle   = '$this->handle',
                mail     = '$this->mail',
                bg       = '$this->bg',
                fbuname  = '$this->fbuname',
                insta    = '$this->insta',
                snap  = '$this->scuname',
                sncode   = '$this->sncode',
                twitterhandle = '$this->twhandle',
                peris    = '$this->perid',
                meerkatid = '$this->meerkatid',
                tumblr   = '$this->tumbuname',
                website  = '$this->website',
                tagline1 = '$this->tagline[0]',
                tagline2 = '$this->tagline[1]'
                ";
      $retval = $con->query($sql);
      if(! $retval ) {
        die('Could not enter data: (' . $con->errno.")". $con->error);
      }

      echo "Entered data successfully\n";
    }



    public $uuid        ; //if created with fb == fbuuid otherwise dunno
    public $u_mail      ; //User email
    public $displayName ; // Real Name
    public $handle      ; // username...
    public $bg          ; //Background pciture
    public $fbuname     ; //Facebook user name
    public $insta       ; // Instagram handle
    public $scuname     ; //snapchat user name
    public $sccode      ; //snapcope
    public $twhandle    ; //twitter handle
    public $tumbuname   ; //tumblr
    public $perid       ; // periscope
    public $meerkatid   ; //meerkat
    public $tagline     ;
    public $website     ;

  }


 ?>
