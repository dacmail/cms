<div class="form-group {{ $errors->has('captcha') ? 'has-error' : '' }}">
    <label class="control-label">* Código de seguridad</label><br>
    {!! captcha_img('flat') !!}<br><br>
    <input type="text" name="captcha" class="form-control" required>
    {!! $errors->first('captcha', '<span class="help-block">:message</span>') !!}
</div>