export const _errorNetwork = () => ({
    code: 504,
    msg: 'Kết nối mạng có vấn đề vui lòng xem lại',
    data: false,
    funct: '_errorNetwork'
})

export const _errorResquestNotFound = url => ({
    code: 404,
    msg: `${url} không tồn tại`,
    data: false,
    funct: '_errorResquestNotFound'
})

export const _errorOnTryCatch = (err, message) => {
    return {
        code: 9999,
        msg: message || `Có lỗi xảy ra, hãy kiểm lại thông tin`,
        data: false,
        catch: err.message,
        funct: '_errorOnTryCatch'
    }
}

export const _errorDataNotFound = message => ({
    code: 404,
    msg: message || `Dữ liệu không tồn tại`,
    data: null,
    funct: '_errorOnTryCatch'
})

export const _errorUnauthorized = message => ({
    code: 401,
    msg: message || `Không có quyền truy cập`,
    data: null,
    funct: '_errorOnTryCatch'
})

export const _success = (res, message) => ({
    code: 0,
    message: message || 'Thành công',
    data: res
})

export const _error = (message = 'error', code = 9999) => ({
    code: code,
    msg: message || `Có lỗi xảy ra, vui lòng quay lại sau`,
    data: false,
    funct: '_error'
})
