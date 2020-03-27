import imgkit
import requests
import config

FACEBOOK_POST_PHOTO_API = 'https://graph.facebook.com/v5.0/{pageId}/feed'
FACEBOOK_PHOTO_API = 'https://graph.facebook.com/v5.0/{pageId}/photos';

options = {'width': config.IMG_WIDTH, 'disable-smart-width': ''}


photos = []


def get_news():
    news_list_response = requests.get(config.HTML_BASE_URL + '/get_news.php')
    return news_list_response.json()


def submit_article(photos):
    post_options = {
        "access_token": config.FACEBOOK_CONFIG['facebook_token'],
        "message": config.POST_CONTENT,
        "attached_media": photos
    }
    response = requests.post(FACEBOOK_POST_PHOTO_API.replace('{pageId}', config.FACEBOOK_CONFIG['page_id']), json=post_options)
    if response:
        return response.json()
    else:
        raise Exception("Can not submit post: " + response.text)


def upload_file(file_path):
    url = 'https://api.imgbb.com/1/upload'
    files = {
        'image': open(file_path, 'rb'),
    }
    data = {
        'key': config.IMGBB_KEY
    }
    res = requests.post(url, files=files, data=data)
    data_res = res.json()
    img_url = data_res['data']['url']
    data_photo = {
        "access_token": config.FACEBOOK_CONFIG['facebook_token'],
        "caption": config.POST_CONTENT,
        "url": img_url,
        "published": False
    }
    response = requests.post(FACEBOOK_PHOTO_API.replace('{pageId}', config.FACEBOOK_CONFIG['page_id']), json=data_photo)
    if response:
        return response.json()
    else:
        return None


def main():
    i = 0
    for news in get_news():
        if news['title']:
            i = i + 1
            output = './imgs/news_'+ str(i) +'.jpg'
            imgkit.from_url(config.HTML_BASE_URL + '/news_html_preview.php?url='+ news['link'], output, options=options)
            print("Tạo thành công ..." + str(i) + " Ảnh")
            photo = upload_file(output)
            print("Đăng thành công ...." + str(i) + " Ảnh")
            photos.append({ "media_fbid": photo['id']})

    print("....Đang đăng bài viết")
    submit_article(photos)
    print("Đăng thành công!")


if __name__== "__main__":
    main()