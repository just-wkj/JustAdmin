<?php


namespace app\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate {
    /**
     * 检测所有客户端发来的参数是否符合验证类规则
     * 基类定义了很多自定义验证方法
     * 这些自定义验证方法其实，也可以直接调用,自定义校验返回必须是bool值,否则不提示信息
     * @return true
     * @throws ParameterException
     */
    public function goCheck() {
        $request = Request::instance();
        $params = $request->param();
        //$params['token'] = $request->header('token');

        if (!$this->check($params)) {
            throw new ParameterException([
                'msg' => is_array($this->error) ? implode(';', $this->error) : $this->error,
            ]);
        }
        return true;
    }

    /**
     * @param array $arrays 通常传入request.post变量数组
     * @return array 按照规则key过滤后的变量数组
     * @throws ParameterException
     */
    public function getDataByRule($arrays) {
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }

    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '') {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return $field . '必须是正整数';
    }

    /**
     * 空字符串
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool|string
     * @author: justwkj
     * @date: 2019-08-06 13:13
     */
    protected function isNotEmptyString($value, $rule = '', $data = '', $field = '') {
        $value = strval($value);
        $value = trim($value);
        if (0 === strlen($value)) {
            return $field . '不允许为空';
        }
        return true;
    }


    protected function isNotEmpty($value, $rule = '', $data = '', $field = '') {
        if (empty($value)) {
            return $field . '不允许为空';
        }
        return true;
    }


    /**
     * 校验手机号
     * @param $value
     * @param string $rule
     * @param string $data
     * @return bool
     */
    protected function isPhone($value, $rule = '', $data = '') {
        return (bool)preg_match('/^1[3-9]\d{9}$/', $value);
    }

    /**
     * 结束时间校验,是否大于开始时间 'end_time' => 'require|timeRange:start_time',
     * @access protected
     * @param mixed $value 字段值
     * @param mixed $rule 验证规则
     * @param array $data 数据
     * @return bool
     */
    protected function timeRange($value, $rule = '', $data = '') {
        $start = $this->getDataValue($data, $rule);
        $end = $value;
        return strtotime($start) < strtotime($end);
    }


    /**
     * 禁止传递字段
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return string
     * @author: justwkj
     * @date: 2019-08-06 11:32
     */
    protected function forbidden($value, $rule = '', $data = '', $field = '') {
        return "字段${field}禁止传递";
    }
}
