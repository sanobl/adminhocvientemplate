<?php
/**
 * Autogenerated by Thrift
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 */
include_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';


$GLOBALS['comment_E_ErrorCode'] = array(
  'NONE' => 0,
  'NORMAL' => 1,
  'IDGEN_FAIL' => 2,
  'SPAM' => 3,
  'NOT_ALLOW' => 4,
  'WRONG_APPID' => 5,
);

final class comment_ErrorCode {
  const NONE = 0;
  const NORMAL = 1;
  const IDGEN_FAIL = 2;
  const SPAM = 3;
  const NOT_ALLOW = 4;
  const WRONG_APPID = 5;
  static public $__names = array(
    0 => 'NONE',
    1 => 'NORMAL',
    2 => 'IDGEN_FAIL',
    3 => 'SPAM',
    4 => 'NOT_ALLOW',
    5 => 'WRONG_APPID',
  );
}

class comment_Result {
  static $_TSPEC;

  public $error = null;
  public $value = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'error',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'value',
          'type' => TType::I64,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['error'])) {
        $this->error = $vals['error'];
      }
      if (isset($vals['value'])) {
        $this->value = $vals['value'];
      }
    }
  }

  public function getName() {
    return 'Result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->error);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->value);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('Result');
    if ($this->error !== null) {
      $xfer += $output->writeFieldBegin('error', TType::I32, 1);
      $xfer += $output->writeI32($this->error);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->value !== null) {
      $xfer += $output->writeFieldBegin('value', TType::I64, 2);
      $xfer += $output->writeI64($this->value);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class comment_FeedNObject {
  static $_TSPEC;

  public $feedId = null;
  public $appId = null;
  public $objectId = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'feedId',
          'type' => TType::I64,
          ),
        2 => array(
          'var' => 'appId',
          'type' => TType::I16,
          ),
        3 => array(
          'var' => 'objectId',
          'type' => TType::I64,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['feedId'])) {
        $this->feedId = $vals['feedId'];
      }
      if (isset($vals['appId'])) {
        $this->appId = $vals['appId'];
      }
      if (isset($vals['objectId'])) {
        $this->objectId = $vals['objectId'];
      }
    }
  }

  public function getName() {
    return 'FeedNObject';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->feedId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->appId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->objectId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('FeedNObject');
    if ($this->feedId !== null) {
      $xfer += $output->writeFieldBegin('feedId', TType::I64, 1);
      $xfer += $output->writeI64($this->feedId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->appId !== null) {
      $xfer += $output->writeFieldBegin('appId', TType::I16, 2);
      $xfer += $output->writeI16($this->appId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->objectId !== null) {
      $xfer += $output->writeFieldBegin('objectId', TType::I64, 3);
      $xfer += $output->writeI64($this->objectId);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class comment_Comment {
  static $_TSPEC;

  public $commentId = null;
  public $ownerId = null;
  public $fromId = null;
  public $toId = null;
  public $time = null;
  public $content = null;
  public $source = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'commentId',
          'type' => TType::I64,
          ),
        2 => array(
          'var' => 'ownerId',
          'type' => TType::I32,
          ),
        3 => array(
          'var' => 'fromId',
          'type' => TType::I32,
          ),
        4 => array(
          'var' => 'toId',
          'type' => TType::I32,
          ),
        5 => array(
          'var' => 'time',
          'type' => TType::I32,
          ),
        6 => array(
          'var' => 'content',
          'type' => TType::STRING,
          ),
        7 => array(
          'var' => 'source',
          'type' => TType::BYTE,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['commentId'])) {
        $this->commentId = $vals['commentId'];
      }
      if (isset($vals['ownerId'])) {
        $this->ownerId = $vals['ownerId'];
      }
      if (isset($vals['fromId'])) {
        $this->fromId = $vals['fromId'];
      }
      if (isset($vals['toId'])) {
        $this->toId = $vals['toId'];
      }
      if (isset($vals['time'])) {
        $this->time = $vals['time'];
      }
      if (isset($vals['content'])) {
        $this->content = $vals['content'];
      }
      if (isset($vals['source'])) {
        $this->source = $vals['source'];
      }
    }
  }

  public function getName() {
    return 'Comment';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->commentId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->ownerId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->fromId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->toId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->time);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->content);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::BYTE) {
            $xfer += $input->readByte($this->source);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('Comment');
    if ($this->commentId !== null) {
      $xfer += $output->writeFieldBegin('commentId', TType::I64, 1);
      $xfer += $output->writeI64($this->commentId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->ownerId !== null) {
      $xfer += $output->writeFieldBegin('ownerId', TType::I32, 2);
      $xfer += $output->writeI32($this->ownerId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->fromId !== null) {
      $xfer += $output->writeFieldBegin('fromId', TType::I32, 3);
      $xfer += $output->writeI32($this->fromId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->toId !== null) {
      $xfer += $output->writeFieldBegin('toId', TType::I32, 4);
      $xfer += $output->writeI32($this->toId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->time !== null) {
      $xfer += $output->writeFieldBegin('time', TType::I32, 5);
      $xfer += $output->writeI32($this->time);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->content !== null) {
      $xfer += $output->writeFieldBegin('content', TType::STRING, 6);
      $xfer += $output->writeString($this->content);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->source !== null) {
      $xfer += $output->writeFieldBegin('source', TType::BYTE, 7);
      $xfer += $output->writeByte($this->source);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class comment_ObjectComment {
  static $_TSPEC;

  public $objectId = null;
  public $total = null;
  public $listComment = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'objectId',
          'type' => TType::I64,
          ),
        2 => array(
          'var' => 'total',
          'type' => TType::I32,
          ),
        3 => array(
          'var' => 'listComment',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => 'comment_Comment',
            ),
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['objectId'])) {
        $this->objectId = $vals['objectId'];
      }
      if (isset($vals['total'])) {
        $this->total = $vals['total'];
      }
      if (isset($vals['listComment'])) {
        $this->listComment = $vals['listComment'];
      }
    }
  }

  public function getName() {
    return 'ObjectComment';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->objectId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->total);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::LST) {
            $this->listComment = array();
            $_size0 = 0;
            $_etype3 = 0;
            $xfer += $input->readListBegin($_etype3, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $elem5 = null;
              $elem5 = new comment_Comment();
              $xfer += $elem5->read($input);
              $this->listComment []= $elem5;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('ObjectComment');
    if ($this->objectId !== null) {
      $xfer += $output->writeFieldBegin('objectId', TType::I64, 1);
      $xfer += $output->writeI64($this->objectId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->total !== null) {
      $xfer += $output->writeFieldBegin('total', TType::I32, 2);
      $xfer += $output->writeI32($this->total);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->listComment !== null) {
      if (!is_array($this->listComment)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('listComment', TType::LST, 3);
      {
        $output->writeListBegin(TType::STRUCT, count($this->listComment));
        {
          foreach ($this->listComment as $iter6)
          {
            $xfer += $iter6->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

?>
