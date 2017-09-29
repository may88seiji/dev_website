<?php

if(in_category('gift'))
{
  get_template_part('single/gift');
}
elseif(is_singular('post') || is_singular('news'))
{
  get_template_part('single/post');
}
