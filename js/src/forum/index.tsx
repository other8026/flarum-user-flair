import {extend} from 'flarum/common/extend';
import app from 'flarum/forum/app';
import UserControls from 'flarum/forum/utils/UserControls'
import Button from 'flarum/common/components/Button';
// import Badge from 'flarum/common/components/Badge';
// import User from 'flarum/common/models/User';

export {default as extend} from './extendUser';

app.initializers.add('other8026/user-flair', () => {
  extend(UserControls, 'moderationControls', (items, user) => {
    if (user.canSetUserFlair()) {
      items.add(
        'suspend',
        // <Button icon="fas fa-ban" onclick={() => app.modal.show(SuspendUserModal, { user })}>
        <Button icon="fas fa-input-text" onclick={() => alert("placeholder")}>
          {app.translator.trans('other8026-user-flair.forum.user_controls.set_flair_button')}
        </Button>
      );
    }
  });
});
