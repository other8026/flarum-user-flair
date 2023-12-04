/*
based on https://github.com/flarum/suspend/blob/main/js/src/forum/extend.ts
 */

import Extend from 'flarum/common/extenders';
import User from 'flarum/common/models/User';

export default [
  new Extend.Model(User)
    .attribute<boolean>('canSetUserFlair')
    .attribute<String|null>('userFlair')
];
