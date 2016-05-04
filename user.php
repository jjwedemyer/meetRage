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
      $this->uuid         = $data['UUID'];
      $this->u_mail       = $this->setMail($data['mail']);
      $this->displayName  = $data['name'];
      $this->handle       = $this->creHandle($data['name']);
      $this->bg           = $data['bg'];
      $this->fbuname      = $data['fbuname'];
      $this->insta        = $data['insta'];
      $this->scuname      = $data['scuname'];
      $this->sccode       = $data['sccode'];
      $this->twhandle     = $data['twhandle'];
      $this->tumbuname    = $data['tumbuname'];
      $this->perid        = $data['perid'];
      $this->meerkat    = $data['meerkat'];
      $this->tagline      = $data['tagline'];
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
      return $handle;
    }

    function setMail($mail)
    {
      if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return $mail;
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
      $date = time();
      $sql  = "INSERT INTO user".
              "(UUID,realname,handle,mail,bg,fbuname,insta,snap,sncode,twitterhandle,peris,meerkatid,tumblr,join_date)".
              "VALUES('$this->uuid','$this->displayName','$this->handle','$this->mail','$this->bg','$this->fbuname','$this->insta','$this->scuname','$this->sccode','$this->twhandle','$this->perid','$this->meerkatid','$this->tumbuname',NOW())".
              "ON DUPLICATE KEY UPDATE
                realname = '$this->displayName',
                handle   = '$this->handle',
                mail'    = '$this->mail',
                bg'      = '$this->bg',
                fbuname' = '$this->fbuname',
                insta'   = '$this->insta',
                scuname' = '$this->scuname',
                sncode'  = '$this->sncode',
                twitterhandle' = '$this->twhandle',
                peris'    = '$this->perid',
                meerkatid' = '$this->meerkatid',
                tumblr'   = '$this->tumbuname'
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

  }


 ?>
