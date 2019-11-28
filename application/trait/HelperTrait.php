<?php


/**
 * Trait Helper 辅助工具
 * @fanzhaogui fanzhaogui
 */
trait Helper
{
    public function renderJSON($res)
    {
        header('Content-Type:application/json; charset=utf-8');
        if (empty($res)) {
            $res = $this->initRes();
        }

        $jsonString = json_encode($res, JSON_UNESCAPED_UNICODE);
        echo $jsonString;

        exit;
    }


    /**
     * 错误时json输出
     *
     * @param int $code 错误代码
     * @param string $msg 错误信息
     * @return void
     */
    public function errorOutput($code, $msg = '')
    {
        $res       = $this->initRes();
        $res->code = $code;
        if ($msg) {
            $res->msg = $msg;
        } else {
            $res->msg = 'unknow  message';
        }
        $this->error = true;
        $this->renderJSON($res);
    }

    static public function errorStaticOutput($code, $msg = '')
    {
        (new self())->errorOutput($code, $msg);
    }

    /**
     * 成功时的返回
     *
     * @param mixed $data 返回的数据
     * @return void
     */
    public function successOutput($data = array(), $msg = '')
    {
        $res = $this->initRes();
        if (is_string($msg) && trim($msg)) {
            $res->msg = $msg;
        }
        if (!empty($data)) { //注意： 不为空时不进行覆盖 data字段，因为data字段是对象类型
            $res->data = $data;
        }
        $this->renderJSON($res);
    }


    /**
     * initRes 初始化返回的结果
     * @author: fanzhaogui
     * @date 2019-10-25
     * @param bool $isObject
     * @return \stdClass
     */
    public function initRes($isObject = true)
    {
        $res        = new \stdClass();
        $res->code  = ErrorCode::SUCCESS;
        $res->msg   = 'success';
        $res->param = I();
        if ($isObject) {
            $res->data = new \stdClass();
        } else {
            $res->data = array();
        }

        return $res;
    }

}