import {extend} from 'flarum/common/extend';
import {override} from 'flarum/common/extend';
import Link from 'flarum/common/components/Link';
import UserCard from 'flarum/forum/components/UserCard';
import app from 'flarum/forum/app';
import avatar from 'flarum/common/helpers/avatar';
import username from 'flarum/common/helpers/username';
import userOnline from 'flarum/common/helpers/userOnline';
import listItems from 'flarum/common/helpers/listItems';
import UserControls from 'flarum/forum/utils/UserControls'
import Button from 'flarum/common/components/Button';
import PostUser from 'flarum/forum/components/PostUser';

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

  override(PostUser.prototype, 'view', function () {
    // flarum doesn't make it easy to modify this part of forum,
    // so this needs to be copied and pasted from the source,
    // just need to add the small bit of stuff for the user's flair
    // https://github.com/flarum/flarum-core/blob/v1.8.0/js/src/forum/components/PostUser.js

    const post = this.attrs.post;
    const user = post.user();

    if (!user) {
      return (
        <div className="PostUser">
          <h3 className="PostUser-name">
            {avatar(user, {className: 'PostUser-avatar'})} {username(user)}
          </h3>
        </div>
      );
    }

    return (
      <div className="PostUser">
        <h3 className="PostUser-name">
          <Link href={app.route.user(user)}>
            {avatar(user, {className: 'PostUser-avatar'})}
            {userOnline(user)}
            {username(user)}
            <span class="user-flair">{user.userFlair()}</span>
          </Link>
        </h3>
        <ul className="PostUser-badges badges">{listItems(user.badges().toArray())}</ul>

        {!post.isHidden() && this.attrs.cardVisible && (
          <UserCard user={user} className="UserCard--popover"
                    controlsButtonClassName="Button Button--icon Button--flat"/>
        )}
      </div>
    );
  });
});
