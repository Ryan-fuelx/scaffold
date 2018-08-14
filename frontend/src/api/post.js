import request from '@/utils/request'

export function PostIndex() {
  return request({
    url: `/post`,
    method: 'get'
    // params
  })
}

export function PostStore(data) {
  return request({
    // params,
    data,
    url: `/post`,
    method: 'post'
  })
}

export function PostShow(id) {
  return request({
    url: `/post/${id}`,
    method: 'get'
    // params
  })
}

export function PostUpdate(id, data) {
  return request({
    // params,
    data,
    url: `/post/${id}`,
    method: 'put'
  })
}

export function PostDestroy(id) {
  return request({
    // params,
    url: `/post/${id}`,
    method: 'delete'
  })
}
