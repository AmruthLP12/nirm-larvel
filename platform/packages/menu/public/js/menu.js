/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/base64-js/index.js"
/*!*****************************************!*\
  !*** ./node_modules/base64-js/index.js ***!
  \*****************************************/
(__unused_webpack_module, exports) {

"use strict";


exports.byteLength = byteLength
exports.toByteArray = toByteArray
exports.fromByteArray = fromByteArray

var lookup = []
var revLookup = []
var Arr = typeof Uint8Array !== 'undefined' ? Uint8Array : Array

var code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/'
for (var i = 0, len = code.length; i < len; ++i) {
  lookup[i] = code[i]
  revLookup[code.charCodeAt(i)] = i
}

// Support decoding URL-safe base64 strings, as Node.js does.
// See: https://en.wikipedia.org/wiki/Base64#URL_applications
revLookup['-'.charCodeAt(0)] = 62
revLookup['_'.charCodeAt(0)] = 63

function getLens (b64) {
  var len = b64.length

  if (len % 4 > 0) {
    throw new Error('Invalid string. Length must be a multiple of 4')
  }

  // Trim off extra bytes after placeholder bytes are found
  // See: https://github.com/beatgammit/base64-js/issues/42
  var validLen = b64.indexOf('=')
  if (validLen === -1) validLen = len

  var placeHoldersLen = validLen === len
    ? 0
    : 4 - (validLen % 4)

  return [validLen, placeHoldersLen]
}

// base64 is 4/3 + up to two characters of the original data
function byteLength (b64) {
  var lens = getLens(b64)
  var validLen = lens[0]
  var placeHoldersLen = lens[1]
  return ((validLen + placeHoldersLen) * 3 / 4) - placeHoldersLen
}

function _byteLength (b64, validLen, placeHoldersLen) {
  return ((validLen + placeHoldersLen) * 3 / 4) - placeHoldersLen
}

function toByteArray (b64) {
  var tmp
  var lens = getLens(b64)
  var validLen = lens[0]
  var placeHoldersLen = lens[1]

  var arr = new Arr(_byteLength(b64, validLen, placeHoldersLen))

  var curByte = 0

  // if there are placeholders, only get up to the last complete 4 chars
  var len = placeHoldersLen > 0
    ? validLen - 4
    : validLen

  var i
  for (i = 0; i < len; i += 4) {
    tmp =
      (revLookup[b64.charCodeAt(i)] << 18) |
      (revLookup[b64.charCodeAt(i + 1)] << 12) |
      (revLookup[b64.charCodeAt(i + 2)] << 6) |
      revLookup[b64.charCodeAt(i + 3)]
    arr[curByte++] = (tmp >> 16) & 0xFF
    arr[curByte++] = (tmp >> 8) & 0xFF
    arr[curByte++] = tmp & 0xFF
  }

  if (placeHoldersLen === 2) {
    tmp =
      (revLookup[b64.charCodeAt(i)] << 2) |
      (revLookup[b64.charCodeAt(i + 1)] >> 4)
    arr[curByte++] = tmp & 0xFF
  }

  if (placeHoldersLen === 1) {
    tmp =
      (revLookup[b64.charCodeAt(i)] << 10) |
      (revLookup[b64.charCodeAt(i + 1)] << 4) |
      (revLookup[b64.charCodeAt(i + 2)] >> 2)
    arr[curByte++] = (tmp >> 8) & 0xFF
    arr[curByte++] = tmp & 0xFF
  }

  return arr
}

function tripletToBase64 (num) {
  return lookup[num >> 18 & 0x3F] +
    lookup[num >> 12 & 0x3F] +
    lookup[num >> 6 & 0x3F] +
    lookup[num & 0x3F]
}

function encodeChunk (uint8, start, end) {
  var tmp
  var output = []
  for (var i = start; i < end; i += 3) {
    tmp =
      ((uint8[i] << 16) & 0xFF0000) +
      ((uint8[i + 1] << 8) & 0xFF00) +
      (uint8[i + 2] & 0xFF)
    output.push(tripletToBase64(tmp))
  }
  return output.join('')
}

function fromByteArray (uint8) {
  var tmp
  var len = uint8.length
  var extraBytes = len % 3 // if we have 1 byte left, pad 2 bytes
  var parts = []
  var maxChunkLength = 16383 // must be multiple of 3

  // go through the array every three bytes, we'll deal with trailing stuff later
  for (var i = 0, len2 = len - extraBytes; i < len2; i += maxChunkLength) {
    parts.push(encodeChunk(uint8, i, (i + maxChunkLength) > len2 ? len2 : (i + maxChunkLength)))
  }

  // pad the end with zeros, but make sure to not forget the extra bytes
  if (extraBytes === 1) {
    tmp = uint8[len - 1]
    parts.push(
      lookup[tmp >> 2] +
      lookup[(tmp << 4) & 0x3F] +
      '=='
    )
  } else if (extraBytes === 2) {
    tmp = (uint8[len - 2] << 8) + uint8[len - 1]
    parts.push(
      lookup[tmp >> 10] +
      lookup[(tmp >> 4) & 0x3F] +
      lookup[(tmp << 2) & 0x3F] +
      '='
    )
  }

  return parts.join('')
}


/***/ },

/***/ "./node_modules/buffer/index.js"
/*!**************************************!*\
  !*** ./node_modules/buffer/index.js ***!
  \**************************************/
(__unused_webpack_module, exports, __webpack_require__) {

"use strict";
/*!
 * The buffer module from node.js, for the browser.
 *
 * @author   Feross Aboukhadijeh <http://feross.org>
 * @license  MIT
 */
/* eslint-disable no-proto */



var base64 = __webpack_require__(/*! base64-js */ "./node_modules/base64-js/index.js")
var ieee754 = __webpack_require__(/*! ieee754 */ "./node_modules/ieee754/index.js")
var isArray = __webpack_require__(/*! isarray */ "./node_modules/isarray/index.js")

exports.Buffer = Buffer
exports.SlowBuffer = SlowBuffer
exports.INSPECT_MAX_BYTES = 50

/**
 * If `Buffer.TYPED_ARRAY_SUPPORT`:
 *   === true    Use Uint8Array implementation (fastest)
 *   === false   Use Object implementation (most compatible, even IE6)
 *
 * Browsers that support typed arrays are IE 10+, Firefox 4+, Chrome 7+, Safari 5.1+,
 * Opera 11.6+, iOS 4.2+.
 *
 * Due to various browser bugs, sometimes the Object implementation will be used even
 * when the browser supports typed arrays.
 *
 * Note:
 *
 *   - Firefox 4-29 lacks support for adding new properties to `Uint8Array` instances,
 *     See: https://bugzilla.mozilla.org/show_bug.cgi?id=695438.
 *
 *   - Chrome 9-10 is missing the `TypedArray.prototype.subarray` function.
 *
 *   - IE10 has a broken `TypedArray.prototype.subarray` function which returns arrays of
 *     incorrect length in some situations.

 * We detect these buggy browsers and set `Buffer.TYPED_ARRAY_SUPPORT` to `false` so they
 * get the Object implementation, which is slower but behaves correctly.
 */
Buffer.TYPED_ARRAY_SUPPORT = __webpack_require__.g.TYPED_ARRAY_SUPPORT !== undefined
  ? __webpack_require__.g.TYPED_ARRAY_SUPPORT
  : typedArraySupport()

/*
 * Export kMaxLength after typed array support is determined.
 */
exports.kMaxLength = kMaxLength()

function typedArraySupport () {
  try {
    var arr = new Uint8Array(1)
    arr.__proto__ = {__proto__: Uint8Array.prototype, foo: function () { return 42 }}
    return arr.foo() === 42 && // typed array instances can be augmented
        typeof arr.subarray === 'function' && // chrome 9-10 lack `subarray`
        arr.subarray(1, 1).byteLength === 0 // ie10 has broken `subarray`
  } catch (e) {
    return false
  }
}

function kMaxLength () {
  return Buffer.TYPED_ARRAY_SUPPORT
    ? 0x7fffffff
    : 0x3fffffff
}

function createBuffer (that, length) {
  if (kMaxLength() < length) {
    throw new RangeError('Invalid typed array length')
  }
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    // Return an augmented `Uint8Array` instance, for best performance
    that = new Uint8Array(length)
    that.__proto__ = Buffer.prototype
  } else {
    // Fallback: Return an object instance of the Buffer class
    if (that === null) {
      that = new Buffer(length)
    }
    that.length = length
  }

  return that
}

/**
 * The Buffer constructor returns instances of `Uint8Array` that have their
 * prototype changed to `Buffer.prototype`. Furthermore, `Buffer` is a subclass of
 * `Uint8Array`, so the returned instances will have all the node `Buffer` methods
 * and the `Uint8Array` methods. Square bracket notation works as expected -- it
 * returns a single octet.
 *
 * The `Uint8Array` prototype remains unmodified.
 */

function Buffer (arg, encodingOrOffset, length) {
  if (!Buffer.TYPED_ARRAY_SUPPORT && !(this instanceof Buffer)) {
    return new Buffer(arg, encodingOrOffset, length)
  }

  // Common case.
  if (typeof arg === 'number') {
    if (typeof encodingOrOffset === 'string') {
      throw new Error(
        'If encoding is specified then the first argument must be a string'
      )
    }
    return allocUnsafe(this, arg)
  }
  return from(this, arg, encodingOrOffset, length)
}

Buffer.poolSize = 8192 // not used by this implementation

// TODO: Legacy, not needed anymore. Remove in next major version.
Buffer._augment = function (arr) {
  arr.__proto__ = Buffer.prototype
  return arr
}

function from (that, value, encodingOrOffset, length) {
  if (typeof value === 'number') {
    throw new TypeError('"value" argument must not be a number')
  }

  if (typeof ArrayBuffer !== 'undefined' && value instanceof ArrayBuffer) {
    return fromArrayBuffer(that, value, encodingOrOffset, length)
  }

  if (typeof value === 'string') {
    return fromString(that, value, encodingOrOffset)
  }

  return fromObject(that, value)
}

/**
 * Functionally equivalent to Buffer(arg, encoding) but throws a TypeError
 * if value is a number.
 * Buffer.from(str[, encoding])
 * Buffer.from(array)
 * Buffer.from(buffer)
 * Buffer.from(arrayBuffer[, byteOffset[, length]])
 **/
Buffer.from = function (value, encodingOrOffset, length) {
  return from(null, value, encodingOrOffset, length)
}

if (Buffer.TYPED_ARRAY_SUPPORT) {
  Buffer.prototype.__proto__ = Uint8Array.prototype
  Buffer.__proto__ = Uint8Array
  if (typeof Symbol !== 'undefined' && Symbol.species &&
      Buffer[Symbol.species] === Buffer) {
    // Fix subarray() in ES2016. See: https://github.com/feross/buffer/pull/97
    Object.defineProperty(Buffer, Symbol.species, {
      value: null,
      configurable: true
    })
  }
}

function assertSize (size) {
  if (typeof size !== 'number') {
    throw new TypeError('"size" argument must be a number')
  } else if (size < 0) {
    throw new RangeError('"size" argument must not be negative')
  }
}

function alloc (that, size, fill, encoding) {
  assertSize(size)
  if (size <= 0) {
    return createBuffer(that, size)
  }
  if (fill !== undefined) {
    // Only pay attention to encoding if it's a string. This
    // prevents accidentally sending in a number that would
    // be interpretted as a start offset.
    return typeof encoding === 'string'
      ? createBuffer(that, size).fill(fill, encoding)
      : createBuffer(that, size).fill(fill)
  }
  return createBuffer(that, size)
}

/**
 * Creates a new filled Buffer instance.
 * alloc(size[, fill[, encoding]])
 **/
Buffer.alloc = function (size, fill, encoding) {
  return alloc(null, size, fill, encoding)
}

function allocUnsafe (that, size) {
  assertSize(size)
  that = createBuffer(that, size < 0 ? 0 : checked(size) | 0)
  if (!Buffer.TYPED_ARRAY_SUPPORT) {
    for (var i = 0; i < size; ++i) {
      that[i] = 0
    }
  }
  return that
}

/**
 * Equivalent to Buffer(num), by default creates a non-zero-filled Buffer instance.
 * */
Buffer.allocUnsafe = function (size) {
  return allocUnsafe(null, size)
}
/**
 * Equivalent to SlowBuffer(num), by default creates a non-zero-filled Buffer instance.
 */
Buffer.allocUnsafeSlow = function (size) {
  return allocUnsafe(null, size)
}

function fromString (that, string, encoding) {
  if (typeof encoding !== 'string' || encoding === '') {
    encoding = 'utf8'
  }

  if (!Buffer.isEncoding(encoding)) {
    throw new TypeError('"encoding" must be a valid string encoding')
  }

  var length = byteLength(string, encoding) | 0
  that = createBuffer(that, length)

  var actual = that.write(string, encoding)

  if (actual !== length) {
    // Writing a hex string, for example, that contains invalid characters will
    // cause everything after the first invalid character to be ignored. (e.g.
    // 'abxxcd' will be treated as 'ab')
    that = that.slice(0, actual)
  }

  return that
}

function fromArrayLike (that, array) {
  var length = array.length < 0 ? 0 : checked(array.length) | 0
  that = createBuffer(that, length)
  for (var i = 0; i < length; i += 1) {
    that[i] = array[i] & 255
  }
  return that
}

function fromArrayBuffer (that, array, byteOffset, length) {
  array.byteLength // this throws if `array` is not a valid ArrayBuffer

  if (byteOffset < 0 || array.byteLength < byteOffset) {
    throw new RangeError('\'offset\' is out of bounds')
  }

  if (array.byteLength < byteOffset + (length || 0)) {
    throw new RangeError('\'length\' is out of bounds')
  }

  if (byteOffset === undefined && length === undefined) {
    array = new Uint8Array(array)
  } else if (length === undefined) {
    array = new Uint8Array(array, byteOffset)
  } else {
    array = new Uint8Array(array, byteOffset, length)
  }

  if (Buffer.TYPED_ARRAY_SUPPORT) {
    // Return an augmented `Uint8Array` instance, for best performance
    that = array
    that.__proto__ = Buffer.prototype
  } else {
    // Fallback: Return an object instance of the Buffer class
    that = fromArrayLike(that, array)
  }
  return that
}

function fromObject (that, obj) {
  if (Buffer.isBuffer(obj)) {
    var len = checked(obj.length) | 0
    that = createBuffer(that, len)

    if (that.length === 0) {
      return that
    }

    obj.copy(that, 0, 0, len)
    return that
  }

  if (obj) {
    if ((typeof ArrayBuffer !== 'undefined' &&
        obj.buffer instanceof ArrayBuffer) || 'length' in obj) {
      if (typeof obj.length !== 'number' || isnan(obj.length)) {
        return createBuffer(that, 0)
      }
      return fromArrayLike(that, obj)
    }

    if (obj.type === 'Buffer' && isArray(obj.data)) {
      return fromArrayLike(that, obj.data)
    }
  }

  throw new TypeError('First argument must be a string, Buffer, ArrayBuffer, Array, or array-like object.')
}

function checked (length) {
  // Note: cannot use `length < kMaxLength()` here because that fails when
  // length is NaN (which is otherwise coerced to zero.)
  if (length >= kMaxLength()) {
    throw new RangeError('Attempt to allocate Buffer larger than maximum ' +
                         'size: 0x' + kMaxLength().toString(16) + ' bytes')
  }
  return length | 0
}

function SlowBuffer (length) {
  if (+length != length) { // eslint-disable-line eqeqeq
    length = 0
  }
  return Buffer.alloc(+length)
}

Buffer.isBuffer = function isBuffer (b) {
  return !!(b != null && b._isBuffer)
}

Buffer.compare = function compare (a, b) {
  if (!Buffer.isBuffer(a) || !Buffer.isBuffer(b)) {
    throw new TypeError('Arguments must be Buffers')
  }

  if (a === b) return 0

  var x = a.length
  var y = b.length

  for (var i = 0, len = Math.min(x, y); i < len; ++i) {
    if (a[i] !== b[i]) {
      x = a[i]
      y = b[i]
      break
    }
  }

  if (x < y) return -1
  if (y < x) return 1
  return 0
}

Buffer.isEncoding = function isEncoding (encoding) {
  switch (String(encoding).toLowerCase()) {
    case 'hex':
    case 'utf8':
    case 'utf-8':
    case 'ascii':
    case 'latin1':
    case 'binary':
    case 'base64':
    case 'ucs2':
    case 'ucs-2':
    case 'utf16le':
    case 'utf-16le':
      return true
    default:
      return false
  }
}

Buffer.concat = function concat (list, length) {
  if (!isArray(list)) {
    throw new TypeError('"list" argument must be an Array of Buffers')
  }

  if (list.length === 0) {
    return Buffer.alloc(0)
  }

  var i
  if (length === undefined) {
    length = 0
    for (i = 0; i < list.length; ++i) {
      length += list[i].length
    }
  }

  var buffer = Buffer.allocUnsafe(length)
  var pos = 0
  for (i = 0; i < list.length; ++i) {
    var buf = list[i]
    if (!Buffer.isBuffer(buf)) {
      throw new TypeError('"list" argument must be an Array of Buffers')
    }
    buf.copy(buffer, pos)
    pos += buf.length
  }
  return buffer
}

function byteLength (string, encoding) {
  if (Buffer.isBuffer(string)) {
    return string.length
  }
  if (typeof ArrayBuffer !== 'undefined' && typeof ArrayBuffer.isView === 'function' &&
      (ArrayBuffer.isView(string) || string instanceof ArrayBuffer)) {
    return string.byteLength
  }
  if (typeof string !== 'string') {
    string = '' + string
  }

  var len = string.length
  if (len === 0) return 0

  // Use a for loop to avoid recursion
  var loweredCase = false
  for (;;) {
    switch (encoding) {
      case 'ascii':
      case 'latin1':
      case 'binary':
        return len
      case 'utf8':
      case 'utf-8':
      case undefined:
        return utf8ToBytes(string).length
      case 'ucs2':
      case 'ucs-2':
      case 'utf16le':
      case 'utf-16le':
        return len * 2
      case 'hex':
        return len >>> 1
      case 'base64':
        return base64ToBytes(string).length
      default:
        if (loweredCase) return utf8ToBytes(string).length // assume utf8
        encoding = ('' + encoding).toLowerCase()
        loweredCase = true
    }
  }
}
Buffer.byteLength = byteLength

function slowToString (encoding, start, end) {
  var loweredCase = false

  // No need to verify that "this.length <= MAX_UINT32" since it's a read-only
  // property of a typed array.

  // This behaves neither like String nor Uint8Array in that we set start/end
  // to their upper/lower bounds if the value passed is out of range.
  // undefined is handled specially as per ECMA-262 6th Edition,
  // Section 13.3.3.7 Runtime Semantics: KeyedBindingInitialization.
  if (start === undefined || start < 0) {
    start = 0
  }
  // Return early if start > this.length. Done here to prevent potential uint32
  // coercion fail below.
  if (start > this.length) {
    return ''
  }

  if (end === undefined || end > this.length) {
    end = this.length
  }

  if (end <= 0) {
    return ''
  }

  // Force coersion to uint32. This will also coerce falsey/NaN values to 0.
  end >>>= 0
  start >>>= 0

  if (end <= start) {
    return ''
  }

  if (!encoding) encoding = 'utf8'

  while (true) {
    switch (encoding) {
      case 'hex':
        return hexSlice(this, start, end)

      case 'utf8':
      case 'utf-8':
        return utf8Slice(this, start, end)

      case 'ascii':
        return asciiSlice(this, start, end)

      case 'latin1':
      case 'binary':
        return latin1Slice(this, start, end)

      case 'base64':
        return base64Slice(this, start, end)

      case 'ucs2':
      case 'ucs-2':
      case 'utf16le':
      case 'utf-16le':
        return utf16leSlice(this, start, end)

      default:
        if (loweredCase) throw new TypeError('Unknown encoding: ' + encoding)
        encoding = (encoding + '').toLowerCase()
        loweredCase = true
    }
  }
}

// The property is used by `Buffer.isBuffer` and `is-buffer` (in Safari 5-7) to detect
// Buffer instances.
Buffer.prototype._isBuffer = true

function swap (b, n, m) {
  var i = b[n]
  b[n] = b[m]
  b[m] = i
}

Buffer.prototype.swap16 = function swap16 () {
  var len = this.length
  if (len % 2 !== 0) {
    throw new RangeError('Buffer size must be a multiple of 16-bits')
  }
  for (var i = 0; i < len; i += 2) {
    swap(this, i, i + 1)
  }
  return this
}

Buffer.prototype.swap32 = function swap32 () {
  var len = this.length
  if (len % 4 !== 0) {
    throw new RangeError('Buffer size must be a multiple of 32-bits')
  }
  for (var i = 0; i < len; i += 4) {
    swap(this, i, i + 3)
    swap(this, i + 1, i + 2)
  }
  return this
}

Buffer.prototype.swap64 = function swap64 () {
  var len = this.length
  if (len % 8 !== 0) {
    throw new RangeError('Buffer size must be a multiple of 64-bits')
  }
  for (var i = 0; i < len; i += 8) {
    swap(this, i, i + 7)
    swap(this, i + 1, i + 6)
    swap(this, i + 2, i + 5)
    swap(this, i + 3, i + 4)
  }
  return this
}

Buffer.prototype.toString = function toString () {
  var length = this.length | 0
  if (length === 0) return ''
  if (arguments.length === 0) return utf8Slice(this, 0, length)
  return slowToString.apply(this, arguments)
}

Buffer.prototype.equals = function equals (b) {
  if (!Buffer.isBuffer(b)) throw new TypeError('Argument must be a Buffer')
  if (this === b) return true
  return Buffer.compare(this, b) === 0
}

Buffer.prototype.inspect = function inspect () {
  var str = ''
  var max = exports.INSPECT_MAX_BYTES
  if (this.length > 0) {
    str = this.toString('hex', 0, max).match(/.{2}/g).join(' ')
    if (this.length > max) str += ' ... '
  }
  return '<Buffer ' + str + '>'
}

Buffer.prototype.compare = function compare (target, start, end, thisStart, thisEnd) {
  if (!Buffer.isBuffer(target)) {
    throw new TypeError('Argument must be a Buffer')
  }

  if (start === undefined) {
    start = 0
  }
  if (end === undefined) {
    end = target ? target.length : 0
  }
  if (thisStart === undefined) {
    thisStart = 0
  }
  if (thisEnd === undefined) {
    thisEnd = this.length
  }

  if (start < 0 || end > target.length || thisStart < 0 || thisEnd > this.length) {
    throw new RangeError('out of range index')
  }

  if (thisStart >= thisEnd && start >= end) {
    return 0
  }
  if (thisStart >= thisEnd) {
    return -1
  }
  if (start >= end) {
    return 1
  }

  start >>>= 0
  end >>>= 0
  thisStart >>>= 0
  thisEnd >>>= 0

  if (this === target) return 0

  var x = thisEnd - thisStart
  var y = end - start
  var len = Math.min(x, y)

  var thisCopy = this.slice(thisStart, thisEnd)
  var targetCopy = target.slice(start, end)

  for (var i = 0; i < len; ++i) {
    if (thisCopy[i] !== targetCopy[i]) {
      x = thisCopy[i]
      y = targetCopy[i]
      break
    }
  }

  if (x < y) return -1
  if (y < x) return 1
  return 0
}

// Finds either the first index of `val` in `buffer` at offset >= `byteOffset`,
// OR the last index of `val` in `buffer` at offset <= `byteOffset`.
//
// Arguments:
// - buffer - a Buffer to search
// - val - a string, Buffer, or number
// - byteOffset - an index into `buffer`; will be clamped to an int32
// - encoding - an optional encoding, relevant is val is a string
// - dir - true for indexOf, false for lastIndexOf
function bidirectionalIndexOf (buffer, val, byteOffset, encoding, dir) {
  // Empty buffer means no match
  if (buffer.length === 0) return -1

  // Normalize byteOffset
  if (typeof byteOffset === 'string') {
    encoding = byteOffset
    byteOffset = 0
  } else if (byteOffset > 0x7fffffff) {
    byteOffset = 0x7fffffff
  } else if (byteOffset < -0x80000000) {
    byteOffset = -0x80000000
  }
  byteOffset = +byteOffset  // Coerce to Number.
  if (isNaN(byteOffset)) {
    // byteOffset: it it's undefined, null, NaN, "foo", etc, search whole buffer
    byteOffset = dir ? 0 : (buffer.length - 1)
  }

  // Normalize byteOffset: negative offsets start from the end of the buffer
  if (byteOffset < 0) byteOffset = buffer.length + byteOffset
  if (byteOffset >= buffer.length) {
    if (dir) return -1
    else byteOffset = buffer.length - 1
  } else if (byteOffset < 0) {
    if (dir) byteOffset = 0
    else return -1
  }

  // Normalize val
  if (typeof val === 'string') {
    val = Buffer.from(val, encoding)
  }

  // Finally, search either indexOf (if dir is true) or lastIndexOf
  if (Buffer.isBuffer(val)) {
    // Special case: looking for empty string/buffer always fails
    if (val.length === 0) {
      return -1
    }
    return arrayIndexOf(buffer, val, byteOffset, encoding, dir)
  } else if (typeof val === 'number') {
    val = val & 0xFF // Search for a byte value [0-255]
    if (Buffer.TYPED_ARRAY_SUPPORT &&
        typeof Uint8Array.prototype.indexOf === 'function') {
      if (dir) {
        return Uint8Array.prototype.indexOf.call(buffer, val, byteOffset)
      } else {
        return Uint8Array.prototype.lastIndexOf.call(buffer, val, byteOffset)
      }
    }
    return arrayIndexOf(buffer, [ val ], byteOffset, encoding, dir)
  }

  throw new TypeError('val must be string, number or Buffer')
}

function arrayIndexOf (arr, val, byteOffset, encoding, dir) {
  var indexSize = 1
  var arrLength = arr.length
  var valLength = val.length

  if (encoding !== undefined) {
    encoding = String(encoding).toLowerCase()
    if (encoding === 'ucs2' || encoding === 'ucs-2' ||
        encoding === 'utf16le' || encoding === 'utf-16le') {
      if (arr.length < 2 || val.length < 2) {
        return -1
      }
      indexSize = 2
      arrLength /= 2
      valLength /= 2
      byteOffset /= 2
    }
  }

  function read (buf, i) {
    if (indexSize === 1) {
      return buf[i]
    } else {
      return buf.readUInt16BE(i * indexSize)
    }
  }

  var i
  if (dir) {
    var foundIndex = -1
    for (i = byteOffset; i < arrLength; i++) {
      if (read(arr, i) === read(val, foundIndex === -1 ? 0 : i - foundIndex)) {
        if (foundIndex === -1) foundIndex = i
        if (i - foundIndex + 1 === valLength) return foundIndex * indexSize
      } else {
        if (foundIndex !== -1) i -= i - foundIndex
        foundIndex = -1
      }
    }
  } else {
    if (byteOffset + valLength > arrLength) byteOffset = arrLength - valLength
    for (i = byteOffset; i >= 0; i--) {
      var found = true
      for (var j = 0; j < valLength; j++) {
        if (read(arr, i + j) !== read(val, j)) {
          found = false
          break
        }
      }
      if (found) return i
    }
  }

  return -1
}

Buffer.prototype.includes = function includes (val, byteOffset, encoding) {
  return this.indexOf(val, byteOffset, encoding) !== -1
}

Buffer.prototype.indexOf = function indexOf (val, byteOffset, encoding) {
  return bidirectionalIndexOf(this, val, byteOffset, encoding, true)
}

Buffer.prototype.lastIndexOf = function lastIndexOf (val, byteOffset, encoding) {
  return bidirectionalIndexOf(this, val, byteOffset, encoding, false)
}

function hexWrite (buf, string, offset, length) {
  offset = Number(offset) || 0
  var remaining = buf.length - offset
  if (!length) {
    length = remaining
  } else {
    length = Number(length)
    if (length > remaining) {
      length = remaining
    }
  }

  // must be an even number of digits
  var strLen = string.length
  if (strLen % 2 !== 0) throw new TypeError('Invalid hex string')

  if (length > strLen / 2) {
    length = strLen / 2
  }
  for (var i = 0; i < length; ++i) {
    var parsed = parseInt(string.substr(i * 2, 2), 16)
    if (isNaN(parsed)) return i
    buf[offset + i] = parsed
  }
  return i
}

function utf8Write (buf, string, offset, length) {
  return blitBuffer(utf8ToBytes(string, buf.length - offset), buf, offset, length)
}

function asciiWrite (buf, string, offset, length) {
  return blitBuffer(asciiToBytes(string), buf, offset, length)
}

function latin1Write (buf, string, offset, length) {
  return asciiWrite(buf, string, offset, length)
}

function base64Write (buf, string, offset, length) {
  return blitBuffer(base64ToBytes(string), buf, offset, length)
}

function ucs2Write (buf, string, offset, length) {
  return blitBuffer(utf16leToBytes(string, buf.length - offset), buf, offset, length)
}

Buffer.prototype.write = function write (string, offset, length, encoding) {
  // Buffer#write(string)
  if (offset === undefined) {
    encoding = 'utf8'
    length = this.length
    offset = 0
  // Buffer#write(string, encoding)
  } else if (length === undefined && typeof offset === 'string') {
    encoding = offset
    length = this.length
    offset = 0
  // Buffer#write(string, offset[, length][, encoding])
  } else if (isFinite(offset)) {
    offset = offset | 0
    if (isFinite(length)) {
      length = length | 0
      if (encoding === undefined) encoding = 'utf8'
    } else {
      encoding = length
      length = undefined
    }
  // legacy write(string, encoding, offset, length) - remove in v0.13
  } else {
    throw new Error(
      'Buffer.write(string, encoding, offset[, length]) is no longer supported'
    )
  }

  var remaining = this.length - offset
  if (length === undefined || length > remaining) length = remaining

  if ((string.length > 0 && (length < 0 || offset < 0)) || offset > this.length) {
    throw new RangeError('Attempt to write outside buffer bounds')
  }

  if (!encoding) encoding = 'utf8'

  var loweredCase = false
  for (;;) {
    switch (encoding) {
      case 'hex':
        return hexWrite(this, string, offset, length)

      case 'utf8':
      case 'utf-8':
        return utf8Write(this, string, offset, length)

      case 'ascii':
        return asciiWrite(this, string, offset, length)

      case 'latin1':
      case 'binary':
        return latin1Write(this, string, offset, length)

      case 'base64':
        // Warning: maxLength not taken into account in base64Write
        return base64Write(this, string, offset, length)

      case 'ucs2':
      case 'ucs-2':
      case 'utf16le':
      case 'utf-16le':
        return ucs2Write(this, string, offset, length)

      default:
        if (loweredCase) throw new TypeError('Unknown encoding: ' + encoding)
        encoding = ('' + encoding).toLowerCase()
        loweredCase = true
    }
  }
}

Buffer.prototype.toJSON = function toJSON () {
  return {
    type: 'Buffer',
    data: Array.prototype.slice.call(this._arr || this, 0)
  }
}

function base64Slice (buf, start, end) {
  if (start === 0 && end === buf.length) {
    return base64.fromByteArray(buf)
  } else {
    return base64.fromByteArray(buf.slice(start, end))
  }
}

function utf8Slice (buf, start, end) {
  end = Math.min(buf.length, end)
  var res = []

  var i = start
  while (i < end) {
    var firstByte = buf[i]
    var codePoint = null
    var bytesPerSequence = (firstByte > 0xEF) ? 4
      : (firstByte > 0xDF) ? 3
      : (firstByte > 0xBF) ? 2
      : 1

    if (i + bytesPerSequence <= end) {
      var secondByte, thirdByte, fourthByte, tempCodePoint

      switch (bytesPerSequence) {
        case 1:
          if (firstByte < 0x80) {
            codePoint = firstByte
          }
          break
        case 2:
          secondByte = buf[i + 1]
          if ((secondByte & 0xC0) === 0x80) {
            tempCodePoint = (firstByte & 0x1F) << 0x6 | (secondByte & 0x3F)
            if (tempCodePoint > 0x7F) {
              codePoint = tempCodePoint
            }
          }
          break
        case 3:
          secondByte = buf[i + 1]
          thirdByte = buf[i + 2]
          if ((secondByte & 0xC0) === 0x80 && (thirdByte & 0xC0) === 0x80) {
            tempCodePoint = (firstByte & 0xF) << 0xC | (secondByte & 0x3F) << 0x6 | (thirdByte & 0x3F)
            if (tempCodePoint > 0x7FF && (tempCodePoint < 0xD800 || tempCodePoint > 0xDFFF)) {
              codePoint = tempCodePoint
            }
          }
          break
        case 4:
          secondByte = buf[i + 1]
          thirdByte = buf[i + 2]
          fourthByte = buf[i + 3]
          if ((secondByte & 0xC0) === 0x80 && (thirdByte & 0xC0) === 0x80 && (fourthByte & 0xC0) === 0x80) {
            tempCodePoint = (firstByte & 0xF) << 0x12 | (secondByte & 0x3F) << 0xC | (thirdByte & 0x3F) << 0x6 | (fourthByte & 0x3F)
            if (tempCodePoint > 0xFFFF && tempCodePoint < 0x110000) {
              codePoint = tempCodePoint
            }
          }
      }
    }

    if (codePoint === null) {
      // we did not generate a valid codePoint so insert a
      // replacement char (U+FFFD) and advance only 1 byte
      codePoint = 0xFFFD
      bytesPerSequence = 1
    } else if (codePoint > 0xFFFF) {
      // encode to utf16 (surrogate pair dance)
      codePoint -= 0x10000
      res.push(codePoint >>> 10 & 0x3FF | 0xD800)
      codePoint = 0xDC00 | codePoint & 0x3FF
    }

    res.push(codePoint)
    i += bytesPerSequence
  }

  return decodeCodePointsArray(res)
}

// Based on http://stackoverflow.com/a/22747272/680742, the browser with
// the lowest limit is Chrome, with 0x10000 args.
// We go 1 magnitude less, for safety
var MAX_ARGUMENTS_LENGTH = 0x1000

function decodeCodePointsArray (codePoints) {
  var len = codePoints.length
  if (len <= MAX_ARGUMENTS_LENGTH) {
    return String.fromCharCode.apply(String, codePoints) // avoid extra slice()
  }

  // Decode in chunks to avoid "call stack size exceeded".
  var res = ''
  var i = 0
  while (i < len) {
    res += String.fromCharCode.apply(
      String,
      codePoints.slice(i, i += MAX_ARGUMENTS_LENGTH)
    )
  }
  return res
}

function asciiSlice (buf, start, end) {
  var ret = ''
  end = Math.min(buf.length, end)

  for (var i = start; i < end; ++i) {
    ret += String.fromCharCode(buf[i] & 0x7F)
  }
  return ret
}

function latin1Slice (buf, start, end) {
  var ret = ''
  end = Math.min(buf.length, end)

  for (var i = start; i < end; ++i) {
    ret += String.fromCharCode(buf[i])
  }
  return ret
}

function hexSlice (buf, start, end) {
  var len = buf.length

  if (!start || start < 0) start = 0
  if (!end || end < 0 || end > len) end = len

  var out = ''
  for (var i = start; i < end; ++i) {
    out += toHex(buf[i])
  }
  return out
}

function utf16leSlice (buf, start, end) {
  var bytes = buf.slice(start, end)
  var res = ''
  for (var i = 0; i < bytes.length; i += 2) {
    res += String.fromCharCode(bytes[i] + bytes[i + 1] * 256)
  }
  return res
}

Buffer.prototype.slice = function slice (start, end) {
  var len = this.length
  start = ~~start
  end = end === undefined ? len : ~~end

  if (start < 0) {
    start += len
    if (start < 0) start = 0
  } else if (start > len) {
    start = len
  }

  if (end < 0) {
    end += len
    if (end < 0) end = 0
  } else if (end > len) {
    end = len
  }

  if (end < start) end = start

  var newBuf
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    newBuf = this.subarray(start, end)
    newBuf.__proto__ = Buffer.prototype
  } else {
    var sliceLen = end - start
    newBuf = new Buffer(sliceLen, undefined)
    for (var i = 0; i < sliceLen; ++i) {
      newBuf[i] = this[i + start]
    }
  }

  return newBuf
}

/*
 * Need to make sure that buffer isn't trying to write out of bounds.
 */
function checkOffset (offset, ext, length) {
  if ((offset % 1) !== 0 || offset < 0) throw new RangeError('offset is not uint')
  if (offset + ext > length) throw new RangeError('Trying to access beyond buffer length')
}

Buffer.prototype.readUIntLE = function readUIntLE (offset, byteLength, noAssert) {
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) checkOffset(offset, byteLength, this.length)

  var val = this[offset]
  var mul = 1
  var i = 0
  while (++i < byteLength && (mul *= 0x100)) {
    val += this[offset + i] * mul
  }

  return val
}

Buffer.prototype.readUIntBE = function readUIntBE (offset, byteLength, noAssert) {
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) {
    checkOffset(offset, byteLength, this.length)
  }

  var val = this[offset + --byteLength]
  var mul = 1
  while (byteLength > 0 && (mul *= 0x100)) {
    val += this[offset + --byteLength] * mul
  }

  return val
}

Buffer.prototype.readUInt8 = function readUInt8 (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 1, this.length)
  return this[offset]
}

Buffer.prototype.readUInt16LE = function readUInt16LE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 2, this.length)
  return this[offset] | (this[offset + 1] << 8)
}

Buffer.prototype.readUInt16BE = function readUInt16BE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 2, this.length)
  return (this[offset] << 8) | this[offset + 1]
}

Buffer.prototype.readUInt32LE = function readUInt32LE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)

  return ((this[offset]) |
      (this[offset + 1] << 8) |
      (this[offset + 2] << 16)) +
      (this[offset + 3] * 0x1000000)
}

Buffer.prototype.readUInt32BE = function readUInt32BE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)

  return (this[offset] * 0x1000000) +
    ((this[offset + 1] << 16) |
    (this[offset + 2] << 8) |
    this[offset + 3])
}

Buffer.prototype.readIntLE = function readIntLE (offset, byteLength, noAssert) {
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) checkOffset(offset, byteLength, this.length)

  var val = this[offset]
  var mul = 1
  var i = 0
  while (++i < byteLength && (mul *= 0x100)) {
    val += this[offset + i] * mul
  }
  mul *= 0x80

  if (val >= mul) val -= Math.pow(2, 8 * byteLength)

  return val
}

Buffer.prototype.readIntBE = function readIntBE (offset, byteLength, noAssert) {
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) checkOffset(offset, byteLength, this.length)

  var i = byteLength
  var mul = 1
  var val = this[offset + --i]
  while (i > 0 && (mul *= 0x100)) {
    val += this[offset + --i] * mul
  }
  mul *= 0x80

  if (val >= mul) val -= Math.pow(2, 8 * byteLength)

  return val
}

Buffer.prototype.readInt8 = function readInt8 (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 1, this.length)
  if (!(this[offset] & 0x80)) return (this[offset])
  return ((0xff - this[offset] + 1) * -1)
}

Buffer.prototype.readInt16LE = function readInt16LE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 2, this.length)
  var val = this[offset] | (this[offset + 1] << 8)
  return (val & 0x8000) ? val | 0xFFFF0000 : val
}

Buffer.prototype.readInt16BE = function readInt16BE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 2, this.length)
  var val = this[offset + 1] | (this[offset] << 8)
  return (val & 0x8000) ? val | 0xFFFF0000 : val
}

Buffer.prototype.readInt32LE = function readInt32LE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)

  return (this[offset]) |
    (this[offset + 1] << 8) |
    (this[offset + 2] << 16) |
    (this[offset + 3] << 24)
}

Buffer.prototype.readInt32BE = function readInt32BE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)

  return (this[offset] << 24) |
    (this[offset + 1] << 16) |
    (this[offset + 2] << 8) |
    (this[offset + 3])
}

Buffer.prototype.readFloatLE = function readFloatLE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)
  return ieee754.read(this, offset, true, 23, 4)
}

Buffer.prototype.readFloatBE = function readFloatBE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 4, this.length)
  return ieee754.read(this, offset, false, 23, 4)
}

Buffer.prototype.readDoubleLE = function readDoubleLE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 8, this.length)
  return ieee754.read(this, offset, true, 52, 8)
}

Buffer.prototype.readDoubleBE = function readDoubleBE (offset, noAssert) {
  if (!noAssert) checkOffset(offset, 8, this.length)
  return ieee754.read(this, offset, false, 52, 8)
}

function checkInt (buf, value, offset, ext, max, min) {
  if (!Buffer.isBuffer(buf)) throw new TypeError('"buffer" argument must be a Buffer instance')
  if (value > max || value < min) throw new RangeError('"value" argument is out of bounds')
  if (offset + ext > buf.length) throw new RangeError('Index out of range')
}

Buffer.prototype.writeUIntLE = function writeUIntLE (value, offset, byteLength, noAssert) {
  value = +value
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) {
    var maxBytes = Math.pow(2, 8 * byteLength) - 1
    checkInt(this, value, offset, byteLength, maxBytes, 0)
  }

  var mul = 1
  var i = 0
  this[offset] = value & 0xFF
  while (++i < byteLength && (mul *= 0x100)) {
    this[offset + i] = (value / mul) & 0xFF
  }

  return offset + byteLength
}

Buffer.prototype.writeUIntBE = function writeUIntBE (value, offset, byteLength, noAssert) {
  value = +value
  offset = offset | 0
  byteLength = byteLength | 0
  if (!noAssert) {
    var maxBytes = Math.pow(2, 8 * byteLength) - 1
    checkInt(this, value, offset, byteLength, maxBytes, 0)
  }

  var i = byteLength - 1
  var mul = 1
  this[offset + i] = value & 0xFF
  while (--i >= 0 && (mul *= 0x100)) {
    this[offset + i] = (value / mul) & 0xFF
  }

  return offset + byteLength
}

Buffer.prototype.writeUInt8 = function writeUInt8 (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 1, 0xff, 0)
  if (!Buffer.TYPED_ARRAY_SUPPORT) value = Math.floor(value)
  this[offset] = (value & 0xff)
  return offset + 1
}

function objectWriteUInt16 (buf, value, offset, littleEndian) {
  if (value < 0) value = 0xffff + value + 1
  for (var i = 0, j = Math.min(buf.length - offset, 2); i < j; ++i) {
    buf[offset + i] = (value & (0xff << (8 * (littleEndian ? i : 1 - i)))) >>>
      (littleEndian ? i : 1 - i) * 8
  }
}

Buffer.prototype.writeUInt16LE = function writeUInt16LE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 2, 0xffff, 0)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value & 0xff)
    this[offset + 1] = (value >>> 8)
  } else {
    objectWriteUInt16(this, value, offset, true)
  }
  return offset + 2
}

Buffer.prototype.writeUInt16BE = function writeUInt16BE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 2, 0xffff, 0)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value >>> 8)
    this[offset + 1] = (value & 0xff)
  } else {
    objectWriteUInt16(this, value, offset, false)
  }
  return offset + 2
}

function objectWriteUInt32 (buf, value, offset, littleEndian) {
  if (value < 0) value = 0xffffffff + value + 1
  for (var i = 0, j = Math.min(buf.length - offset, 4); i < j; ++i) {
    buf[offset + i] = (value >>> (littleEndian ? i : 3 - i) * 8) & 0xff
  }
}

Buffer.prototype.writeUInt32LE = function writeUInt32LE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 4, 0xffffffff, 0)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset + 3] = (value >>> 24)
    this[offset + 2] = (value >>> 16)
    this[offset + 1] = (value >>> 8)
    this[offset] = (value & 0xff)
  } else {
    objectWriteUInt32(this, value, offset, true)
  }
  return offset + 4
}

Buffer.prototype.writeUInt32BE = function writeUInt32BE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 4, 0xffffffff, 0)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value >>> 24)
    this[offset + 1] = (value >>> 16)
    this[offset + 2] = (value >>> 8)
    this[offset + 3] = (value & 0xff)
  } else {
    objectWriteUInt32(this, value, offset, false)
  }
  return offset + 4
}

Buffer.prototype.writeIntLE = function writeIntLE (value, offset, byteLength, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) {
    var limit = Math.pow(2, 8 * byteLength - 1)

    checkInt(this, value, offset, byteLength, limit - 1, -limit)
  }

  var i = 0
  var mul = 1
  var sub = 0
  this[offset] = value & 0xFF
  while (++i < byteLength && (mul *= 0x100)) {
    if (value < 0 && sub === 0 && this[offset + i - 1] !== 0) {
      sub = 1
    }
    this[offset + i] = ((value / mul) >> 0) - sub & 0xFF
  }

  return offset + byteLength
}

Buffer.prototype.writeIntBE = function writeIntBE (value, offset, byteLength, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) {
    var limit = Math.pow(2, 8 * byteLength - 1)

    checkInt(this, value, offset, byteLength, limit - 1, -limit)
  }

  var i = byteLength - 1
  var mul = 1
  var sub = 0
  this[offset + i] = value & 0xFF
  while (--i >= 0 && (mul *= 0x100)) {
    if (value < 0 && sub === 0 && this[offset + i + 1] !== 0) {
      sub = 1
    }
    this[offset + i] = ((value / mul) >> 0) - sub & 0xFF
  }

  return offset + byteLength
}

Buffer.prototype.writeInt8 = function writeInt8 (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 1, 0x7f, -0x80)
  if (!Buffer.TYPED_ARRAY_SUPPORT) value = Math.floor(value)
  if (value < 0) value = 0xff + value + 1
  this[offset] = (value & 0xff)
  return offset + 1
}

Buffer.prototype.writeInt16LE = function writeInt16LE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 2, 0x7fff, -0x8000)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value & 0xff)
    this[offset + 1] = (value >>> 8)
  } else {
    objectWriteUInt16(this, value, offset, true)
  }
  return offset + 2
}

Buffer.prototype.writeInt16BE = function writeInt16BE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 2, 0x7fff, -0x8000)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value >>> 8)
    this[offset + 1] = (value & 0xff)
  } else {
    objectWriteUInt16(this, value, offset, false)
  }
  return offset + 2
}

Buffer.prototype.writeInt32LE = function writeInt32LE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 4, 0x7fffffff, -0x80000000)
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value & 0xff)
    this[offset + 1] = (value >>> 8)
    this[offset + 2] = (value >>> 16)
    this[offset + 3] = (value >>> 24)
  } else {
    objectWriteUInt32(this, value, offset, true)
  }
  return offset + 4
}

Buffer.prototype.writeInt32BE = function writeInt32BE (value, offset, noAssert) {
  value = +value
  offset = offset | 0
  if (!noAssert) checkInt(this, value, offset, 4, 0x7fffffff, -0x80000000)
  if (value < 0) value = 0xffffffff + value + 1
  if (Buffer.TYPED_ARRAY_SUPPORT) {
    this[offset] = (value >>> 24)
    this[offset + 1] = (value >>> 16)
    this[offset + 2] = (value >>> 8)
    this[offset + 3] = (value & 0xff)
  } else {
    objectWriteUInt32(this, value, offset, false)
  }
  return offset + 4
}

function checkIEEE754 (buf, value, offset, ext, max, min) {
  if (offset + ext > buf.length) throw new RangeError('Index out of range')
  if (offset < 0) throw new RangeError('Index out of range')
}

function writeFloat (buf, value, offset, littleEndian, noAssert) {
  if (!noAssert) {
    checkIEEE754(buf, value, offset, 4, 3.4028234663852886e+38, -3.4028234663852886e+38)
  }
  ieee754.write(buf, value, offset, littleEndian, 23, 4)
  return offset + 4
}

Buffer.prototype.writeFloatLE = function writeFloatLE (value, offset, noAssert) {
  return writeFloat(this, value, offset, true, noAssert)
}

Buffer.prototype.writeFloatBE = function writeFloatBE (value, offset, noAssert) {
  return writeFloat(this, value, offset, false, noAssert)
}

function writeDouble (buf, value, offset, littleEndian, noAssert) {
  if (!noAssert) {
    checkIEEE754(buf, value, offset, 8, 1.7976931348623157E+308, -1.7976931348623157E+308)
  }
  ieee754.write(buf, value, offset, littleEndian, 52, 8)
  return offset + 8
}

Buffer.prototype.writeDoubleLE = function writeDoubleLE (value, offset, noAssert) {
  return writeDouble(this, value, offset, true, noAssert)
}

Buffer.prototype.writeDoubleBE = function writeDoubleBE (value, offset, noAssert) {
  return writeDouble(this, value, offset, false, noAssert)
}

// copy(targetBuffer, targetStart=0, sourceStart=0, sourceEnd=buffer.length)
Buffer.prototype.copy = function copy (target, targetStart, start, end) {
  if (!start) start = 0
  if (!end && end !== 0) end = this.length
  if (targetStart >= target.length) targetStart = target.length
  if (!targetStart) targetStart = 0
  if (end > 0 && end < start) end = start

  // Copy 0 bytes; we're done
  if (end === start) return 0
  if (target.length === 0 || this.length === 0) return 0

  // Fatal error conditions
  if (targetStart < 0) {
    throw new RangeError('targetStart out of bounds')
  }
  if (start < 0 || start >= this.length) throw new RangeError('sourceStart out of bounds')
  if (end < 0) throw new RangeError('sourceEnd out of bounds')

  // Are we oob?
  if (end > this.length) end = this.length
  if (target.length - targetStart < end - start) {
    end = target.length - targetStart + start
  }

  var len = end - start
  var i

  if (this === target && start < targetStart && targetStart < end) {
    // descending copy from end
    for (i = len - 1; i >= 0; --i) {
      target[i + targetStart] = this[i + start]
    }
  } else if (len < 1000 || !Buffer.TYPED_ARRAY_SUPPORT) {
    // ascending copy from start
    for (i = 0; i < len; ++i) {
      target[i + targetStart] = this[i + start]
    }
  } else {
    Uint8Array.prototype.set.call(
      target,
      this.subarray(start, start + len),
      targetStart
    )
  }

  return len
}

// Usage:
//    buffer.fill(number[, offset[, end]])
//    buffer.fill(buffer[, offset[, end]])
//    buffer.fill(string[, offset[, end]][, encoding])
Buffer.prototype.fill = function fill (val, start, end, encoding) {
  // Handle string cases:
  if (typeof val === 'string') {
    if (typeof start === 'string') {
      encoding = start
      start = 0
      end = this.length
    } else if (typeof end === 'string') {
      encoding = end
      end = this.length
    }
    if (val.length === 1) {
      var code = val.charCodeAt(0)
      if (code < 256) {
        val = code
      }
    }
    if (encoding !== undefined && typeof encoding !== 'string') {
      throw new TypeError('encoding must be a string')
    }
    if (typeof encoding === 'string' && !Buffer.isEncoding(encoding)) {
      throw new TypeError('Unknown encoding: ' + encoding)
    }
  } else if (typeof val === 'number') {
    val = val & 255
  }

  // Invalid ranges are not set to a default, so can range check early.
  if (start < 0 || this.length < start || this.length < end) {
    throw new RangeError('Out of range index')
  }

  if (end <= start) {
    return this
  }

  start = start >>> 0
  end = end === undefined ? this.length : end >>> 0

  if (!val) val = 0

  var i
  if (typeof val === 'number') {
    for (i = start; i < end; ++i) {
      this[i] = val
    }
  } else {
    var bytes = Buffer.isBuffer(val)
      ? val
      : utf8ToBytes(new Buffer(val, encoding).toString())
    var len = bytes.length
    for (i = 0; i < end - start; ++i) {
      this[i + start] = bytes[i % len]
    }
  }

  return this
}

// HELPER FUNCTIONS
// ================

var INVALID_BASE64_RE = /[^+\/0-9A-Za-z-_]/g

function base64clean (str) {
  // Node strips out invalid characters like \n and \t from the string, base64-js does not
  str = stringtrim(str).replace(INVALID_BASE64_RE, '')
  // Node converts strings with length < 2 to ''
  if (str.length < 2) return ''
  // Node allows for non-padded base64 strings (missing trailing ===), base64-js does not
  while (str.length % 4 !== 0) {
    str = str + '='
  }
  return str
}

function stringtrim (str) {
  if (str.trim) return str.trim()
  return str.replace(/^\s+|\s+$/g, '')
}

function toHex (n) {
  if (n < 16) return '0' + n.toString(16)
  return n.toString(16)
}

function utf8ToBytes (string, units) {
  units = units || Infinity
  var codePoint
  var length = string.length
  var leadSurrogate = null
  var bytes = []

  for (var i = 0; i < length; ++i) {
    codePoint = string.charCodeAt(i)

    // is surrogate component
    if (codePoint > 0xD7FF && codePoint < 0xE000) {
      // last char was a lead
      if (!leadSurrogate) {
        // no lead yet
        if (codePoint > 0xDBFF) {
          // unexpected trail
          if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD)
          continue
        } else if (i + 1 === length) {
          // unpaired lead
          if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD)
          continue
        }

        // valid lead
        leadSurrogate = codePoint

        continue
      }

      // 2 leads in a row
      if (codePoint < 0xDC00) {
        if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD)
        leadSurrogate = codePoint
        continue
      }

      // valid surrogate pair
      codePoint = (leadSurrogate - 0xD800 << 10 | codePoint - 0xDC00) + 0x10000
    } else if (leadSurrogate) {
      // valid bmp char, but last char was a lead
      if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD)
    }

    leadSurrogate = null

    // encode utf8
    if (codePoint < 0x80) {
      if ((units -= 1) < 0) break
      bytes.push(codePoint)
    } else if (codePoint < 0x800) {
      if ((units -= 2) < 0) break
      bytes.push(
        codePoint >> 0x6 | 0xC0,
        codePoint & 0x3F | 0x80
      )
    } else if (codePoint < 0x10000) {
      if ((units -= 3) < 0) break
      bytes.push(
        codePoint >> 0xC | 0xE0,
        codePoint >> 0x6 & 0x3F | 0x80,
        codePoint & 0x3F | 0x80
      )
    } else if (codePoint < 0x110000) {
      if ((units -= 4) < 0) break
      bytes.push(
        codePoint >> 0x12 | 0xF0,
        codePoint >> 0xC & 0x3F | 0x80,
        codePoint >> 0x6 & 0x3F | 0x80,
        codePoint & 0x3F | 0x80
      )
    } else {
      throw new Error('Invalid code point')
    }
  }

  return bytes
}

function asciiToBytes (str) {
  var byteArray = []
  for (var i = 0; i < str.length; ++i) {
    // Node's code seems to be doing this and not & 0x7F..
    byteArray.push(str.charCodeAt(i) & 0xFF)
  }
  return byteArray
}

function utf16leToBytes (str, units) {
  var c, hi, lo
  var byteArray = []
  for (var i = 0; i < str.length; ++i) {
    if ((units -= 2) < 0) break

    c = str.charCodeAt(i)
    hi = c >> 8
    lo = c % 256
    byteArray.push(lo)
    byteArray.push(hi)
  }

  return byteArray
}

function base64ToBytes (str) {
  return base64.toByteArray(base64clean(str))
}

function blitBuffer (src, dst, offset, length) {
  for (var i = 0; i < length; ++i) {
    if ((i + offset >= dst.length) || (i >= src.length)) break
    dst[i + offset] = src[i]
  }
  return i
}

function isnan (val) {
  return val !== val // eslint-disable-line no-self-compare
}


/***/ },

/***/ "./node_modules/dayjs/dayjs.min.js"
/*!*****************************************!*\
  !*** ./node_modules/dayjs/dayjs.min.js ***!
  \*****************************************/
(module) {

!function(t,e){ true?module.exports=e():0}(this,(function(){"use strict";var t=1e3,e=6e4,n=36e5,r="millisecond",i="second",s="minute",u="hour",a="day",o="week",c="month",f="quarter",h="year",d="date",l="Invalid Date",$=/^(\d{4})[-/]?(\d{1,2})?[-/]?(\d{0,2})[Tt\s]*(\d{1,2})?:?(\d{1,2})?:?(\d{1,2})?[.:]?(\d+)?$/,y=/\[([^\]]+)]|YYYY|YY|M{1,4}|D{1,2}|d{1,4}|H{1,2}|h{1,2}|a|A|m{1,2}|s{1,2}|Z{1,2}|SSS/g,M={name:"en",weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),ordinal:function(t){var e=["th","st","nd","rd"],n=t%100;return"["+t+(e[(n-20)%10]||e[n]||e[0])+"]"}},m=function(t,e,n){var r=String(t);return!r||r.length>=e?t:""+Array(e+1-r.length).join(n)+t},v={s:m,z:function(t){var e=-t.utcOffset(),n=Math.abs(e),r=Math.floor(n/60),i=n%60;return(e<=0?"+":"-")+m(r,2,"0")+":"+m(i,2,"0")},m:function t(e,n){if(e.date()<n.date())return-t(n,e);var r=12*(n.year()-e.year())+(n.month()-e.month()),i=e.clone().add(r,c),s=n-i<0,u=e.clone().add(r+(s?-1:1),c);return+(-(r+(n-i)/(s?i-u:u-i))||0)},a:function(t){return t<0?Math.ceil(t)||0:Math.floor(t)},p:function(t){return{M:c,y:h,w:o,d:a,D:d,h:u,m:s,s:i,ms:r,Q:f}[t]||String(t||"").toLowerCase().replace(/s$/,"")},u:function(t){return void 0===t}},g="en",D={};D[g]=M;var p="$isDayjsObject",S=function(t){return t instanceof _||!(!t||!t[p])},w=function t(e,n,r){var i;if(!e)return g;if("string"==typeof e){var s=e.toLowerCase();D[s]&&(i=s),n&&(D[s]=n,i=s);var u=e.split("-");if(!i&&u.length>1)return t(u[0])}else{var a=e.name;D[a]=e,i=a}return!r&&i&&(g=i),i||!r&&g},O=function(t,e){if(S(t))return t.clone();var n="object"==typeof e?e:{};return n.date=t,n.args=arguments,new _(n)},b=v;b.l=w,b.i=S,b.w=function(t,e){return O(t,{locale:e.$L,utc:e.$u,x:e.$x,$offset:e.$offset})};var _=function(){function M(t){this.$L=w(t.locale,null,!0),this.parse(t),this.$x=this.$x||t.x||{},this[p]=!0}var m=M.prototype;return m.parse=function(t){this.$d=function(t){var e=t.date,n=t.utc;if(null===e)return new Date(NaN);if(b.u(e))return new Date;if(e instanceof Date)return new Date(e);if("string"==typeof e&&!/Z$/i.test(e)){var r=e.match($);if(r){var i=r[2]-1||0,s=(r[7]||"0").substring(0,3);return n?new Date(Date.UTC(r[1],i,r[3]||1,r[4]||0,r[5]||0,r[6]||0,s)):new Date(r[1],i,r[3]||1,r[4]||0,r[5]||0,r[6]||0,s)}}return new Date(e)}(t),this.init()},m.init=function(){var t=this.$d;this.$y=t.getFullYear(),this.$M=t.getMonth(),this.$D=t.getDate(),this.$W=t.getDay(),this.$H=t.getHours(),this.$m=t.getMinutes(),this.$s=t.getSeconds(),this.$ms=t.getMilliseconds()},m.$utils=function(){return b},m.isValid=function(){return!(this.$d.toString()===l)},m.isSame=function(t,e){var n=O(t);return this.startOf(e)<=n&&n<=this.endOf(e)},m.isAfter=function(t,e){return O(t)<this.startOf(e)},m.isBefore=function(t,e){return this.endOf(e)<O(t)},m.$g=function(t,e,n){return b.u(t)?this[e]:this.set(n,t)},m.unix=function(){return Math.floor(this.valueOf()/1e3)},m.valueOf=function(){return this.$d.getTime()},m.startOf=function(t,e){var n=this,r=!!b.u(e)||e,f=b.p(t),l=function(t,e){var i=b.w(n.$u?Date.UTC(n.$y,e,t):new Date(n.$y,e,t),n);return r?i:i.endOf(a)},$=function(t,e){return b.w(n.toDate()[t].apply(n.toDate("s"),(r?[0,0,0,0]:[23,59,59,999]).slice(e)),n)},y=this.$W,M=this.$M,m=this.$D,v="set"+(this.$u?"UTC":"");switch(f){case h:return r?l(1,0):l(31,11);case c:return r?l(1,M):l(0,M+1);case o:var g=this.$locale().weekStart||0,D=(y<g?y+7:y)-g;return l(r?m-D:m+(6-D),M);case a:case d:return $(v+"Hours",0);case u:return $(v+"Minutes",1);case s:return $(v+"Seconds",2);case i:return $(v+"Milliseconds",3);default:return this.clone()}},m.endOf=function(t){return this.startOf(t,!1)},m.$set=function(t,e){var n,o=b.p(t),f="set"+(this.$u?"UTC":""),l=(n={},n[a]=f+"Date",n[d]=f+"Date",n[c]=f+"Month",n[h]=f+"FullYear",n[u]=f+"Hours",n[s]=f+"Minutes",n[i]=f+"Seconds",n[r]=f+"Milliseconds",n)[o],$=o===a?this.$D+(e-this.$W):e;if(o===c||o===h){var y=this.clone().set(d,1);y.$d[l]($),y.init(),this.$d=y.set(d,Math.min(this.$D,y.daysInMonth())).$d}else l&&this.$d[l]($);return this.init(),this},m.set=function(t,e){return this.clone().$set(t,e)},m.get=function(t){return this[b.p(t)]()},m.add=function(r,f){var d,l=this;r=Number(r);var $=b.p(f),y=function(t){var e=O(l);return b.w(e.date(e.date()+Math.round(t*r)),l)};if($===c)return this.set(c,this.$M+r);if($===h)return this.set(h,this.$y+r);if($===a)return y(1);if($===o)return y(7);var M=(d={},d[s]=e,d[u]=n,d[i]=t,d)[$]||1,m=this.$d.getTime()+r*M;return b.w(m,this)},m.subtract=function(t,e){return this.add(-1*t,e)},m.format=function(t){var e=this,n=this.$locale();if(!this.isValid())return n.invalidDate||l;var r=t||"YYYY-MM-DDTHH:mm:ssZ",i=b.z(this),s=this.$H,u=this.$m,a=this.$M,o=n.weekdays,c=n.months,f=n.meridiem,h=function(t,n,i,s){return t&&(t[n]||t(e,r))||i[n].slice(0,s)},d=function(t){return b.s(s%12||12,t,"0")},$=f||function(t,e,n){var r=t<12?"AM":"PM";return n?r.toLowerCase():r};return r.replace(y,(function(t,r){return r||function(t){switch(t){case"YY":return String(e.$y).slice(-2);case"YYYY":return b.s(e.$y,4,"0");case"M":return a+1;case"MM":return b.s(a+1,2,"0");case"MMM":return h(n.monthsShort,a,c,3);case"MMMM":return h(c,a);case"D":return e.$D;case"DD":return b.s(e.$D,2,"0");case"d":return String(e.$W);case"dd":return h(n.weekdaysMin,e.$W,o,2);case"ddd":return h(n.weekdaysShort,e.$W,o,3);case"dddd":return o[e.$W];case"H":return String(s);case"HH":return b.s(s,2,"0");case"h":return d(1);case"hh":return d(2);case"a":return $(s,u,!0);case"A":return $(s,u,!1);case"m":return String(u);case"mm":return b.s(u,2,"0");case"s":return String(e.$s);case"ss":return b.s(e.$s,2,"0");case"SSS":return b.s(e.$ms,3,"0");case"Z":return i}return null}(t)||i.replace(":","")}))},m.utcOffset=function(){return 15*-Math.round(this.$d.getTimezoneOffset()/15)},m.diff=function(r,d,l){var $,y=this,M=b.p(d),m=O(r),v=(m.utcOffset()-this.utcOffset())*e,g=this-m,D=function(){return b.m(y,m)};switch(M){case h:$=D()/12;break;case c:$=D();break;case f:$=D()/3;break;case o:$=(g-v)/6048e5;break;case a:$=(g-v)/864e5;break;case u:$=g/n;break;case s:$=g/e;break;case i:$=g/t;break;default:$=g}return l?$:b.a($)},m.daysInMonth=function(){return this.endOf(c).$D},m.$locale=function(){return D[this.$L]},m.locale=function(t,e){if(!t)return this.$L;var n=this.clone(),r=w(t,e,!0);return r&&(n.$L=r),n},m.clone=function(){return b.w(this.$d,this)},m.toDate=function(){return new Date(this.valueOf())},m.toJSON=function(){return this.isValid()?this.toISOString():null},m.toISOString=function(){return this.$d.toISOString()},m.toString=function(){return this.$d.toUTCString()},M}(),Y=_.prototype;return O.prototype=Y,[["$ms",r],["$s",i],["$m",s],["$H",u],["$W",a],["$M",c],["$y",h],["$D",d]].forEach((function(t){Y[t[1]]=function(e){return this.$g(e,t[0],t[1])}})),O.extend=function(t,e){return t.$i||(t(e,_,O),t.$i=!0),O},O.locale=w,O.isDayjs=S,O.unix=function(t){return O(1e3*t)},O.en=D[g],O.Ls=D,O.p={},O}));

/***/ },

/***/ "./node_modules/deepmerge/dist/cjs.js"
/*!********************************************!*\
  !*** ./node_modules/deepmerge/dist/cjs.js ***!
  \********************************************/
(module) {

"use strict";


var isMergeableObject = function isMergeableObject(value) {
	return isNonNullObject(value)
		&& !isSpecial(value)
};

function isNonNullObject(value) {
	return !!value && typeof value === 'object'
}

function isSpecial(value) {
	var stringValue = Object.prototype.toString.call(value);

	return stringValue === '[object RegExp]'
		|| stringValue === '[object Date]'
		|| isReactElement(value)
}

// see https://github.com/facebook/react/blob/b5ac963fb791d1298e7f396236383bc955f916c1/src/isomorphic/classic/element/ReactElement.js#L21-L25
var canUseSymbol = typeof Symbol === 'function' && Symbol.for;
var REACT_ELEMENT_TYPE = canUseSymbol ? Symbol.for('react.element') : 0xeac7;

function isReactElement(value) {
	return value.$$typeof === REACT_ELEMENT_TYPE
}

function emptyTarget(val) {
	return Array.isArray(val) ? [] : {}
}

function cloneUnlessOtherwiseSpecified(value, options) {
	return (options.clone !== false && options.isMergeableObject(value))
		? deepmerge(emptyTarget(value), value, options)
		: value
}

function defaultArrayMerge(target, source, options) {
	return target.concat(source).map(function(element) {
		return cloneUnlessOtherwiseSpecified(element, options)
	})
}

function getMergeFunction(key, options) {
	if (!options.customMerge) {
		return deepmerge
	}
	var customMerge = options.customMerge(key);
	return typeof customMerge === 'function' ? customMerge : deepmerge
}

function getEnumerableOwnPropertySymbols(target) {
	return Object.getOwnPropertySymbols
		? Object.getOwnPropertySymbols(target).filter(function(symbol) {
			return Object.propertyIsEnumerable.call(target, symbol)
		})
		: []
}

function getKeys(target) {
	return Object.keys(target).concat(getEnumerableOwnPropertySymbols(target))
}

function propertyIsOnObject(object, property) {
	try {
		return property in object
	} catch(_) {
		return false
	}
}

// Protects from prototype poisoning and unexpected merging up the prototype chain.
function propertyIsUnsafe(target, key) {
	return propertyIsOnObject(target, key) // Properties are safe to merge if they don't exist in the target yet,
		&& !(Object.hasOwnProperty.call(target, key) // unsafe if they exist up the prototype chain,
			&& Object.propertyIsEnumerable.call(target, key)) // and also unsafe if they're nonenumerable.
}

function mergeObject(target, source, options) {
	var destination = {};
	if (options.isMergeableObject(target)) {
		getKeys(target).forEach(function(key) {
			destination[key] = cloneUnlessOtherwiseSpecified(target[key], options);
		});
	}
	getKeys(source).forEach(function(key) {
		if (propertyIsUnsafe(target, key)) {
			return
		}

		if (propertyIsOnObject(target, key) && options.isMergeableObject(source[key])) {
			destination[key] = getMergeFunction(key, options)(target[key], source[key], options);
		} else {
			destination[key] = cloneUnlessOtherwiseSpecified(source[key], options);
		}
	});
	return destination
}

function deepmerge(target, source, options) {
	options = options || {};
	options.arrayMerge = options.arrayMerge || defaultArrayMerge;
	options.isMergeableObject = options.isMergeableObject || isMergeableObject;
	// cloneUnlessOtherwiseSpecified is added to `options` so that custom arrayMerge()
	// implementations can use it. The caller may not replace it.
	options.cloneUnlessOtherwiseSpecified = cloneUnlessOtherwiseSpecified;

	var sourceIsArray = Array.isArray(source);
	var targetIsArray = Array.isArray(target);
	var sourceAndTargetTypesMatch = sourceIsArray === targetIsArray;

	if (!sourceAndTargetTypesMatch) {
		return cloneUnlessOtherwiseSpecified(source, options)
	} else if (sourceIsArray) {
		return options.arrayMerge(target, source, options)
	} else {
		return mergeObject(target, source, options)
	}
}

deepmerge.all = function deepmergeAll(array, options) {
	if (!Array.isArray(array)) {
		throw new Error('first argument should be an array')
	}

	return array.reduce(function(prev, next) {
		return deepmerge(prev, next, options)
	}, {})
};

var deepmerge_1 = deepmerge;

module.exports = deepmerge_1;


/***/ },

/***/ "./node_modules/escape-string-regexp/index.js"
/*!****************************************************!*\
  !*** ./node_modules/escape-string-regexp/index.js ***!
  \****************************************************/
(module) {

"use strict";


module.exports = string => {
	if (typeof string !== 'string') {
		throw new TypeError('Expected a string');
	}

	// Escape characters with special meaning either inside or outside character sets.
	// Use a simple backslash escape when it’s always valid, and a \unnnn escape when the simpler form would be disallowed by Unicode patterns’ stricter grammar.
	return string
		.replace(/[|\\{}()[\]^$+*?.]/g, '\\$&')
		.replace(/-/g, '\\x2d');
};


/***/ },

/***/ "./node_modules/ieee754/index.js"
/*!***************************************!*\
  !*** ./node_modules/ieee754/index.js ***!
  \***************************************/
(__unused_webpack_module, exports) {

/*! ieee754. BSD-3-Clause License. Feross Aboukhadijeh <https://feross.org/opensource> */
exports.read = function (buffer, offset, isLE, mLen, nBytes) {
  var e, m
  var eLen = (nBytes * 8) - mLen - 1
  var eMax = (1 << eLen) - 1
  var eBias = eMax >> 1
  var nBits = -7
  var i = isLE ? (nBytes - 1) : 0
  var d = isLE ? -1 : 1
  var s = buffer[offset + i]

  i += d

  e = s & ((1 << (-nBits)) - 1)
  s >>= (-nBits)
  nBits += eLen
  for (; nBits > 0; e = (e * 256) + buffer[offset + i], i += d, nBits -= 8) {}

  m = e & ((1 << (-nBits)) - 1)
  e >>= (-nBits)
  nBits += mLen
  for (; nBits > 0; m = (m * 256) + buffer[offset + i], i += d, nBits -= 8) {}

  if (e === 0) {
    e = 1 - eBias
  } else if (e === eMax) {
    return m ? NaN : ((s ? -1 : 1) * Infinity)
  } else {
    m = m + Math.pow(2, mLen)
    e = e - eBias
  }
  return (s ? -1 : 1) * m * Math.pow(2, e - mLen)
}

exports.write = function (buffer, value, offset, isLE, mLen, nBytes) {
  var e, m, c
  var eLen = (nBytes * 8) - mLen - 1
  var eMax = (1 << eLen) - 1
  var eBias = eMax >> 1
  var rt = (mLen === 23 ? Math.pow(2, -24) - Math.pow(2, -77) : 0)
  var i = isLE ? 0 : (nBytes - 1)
  var d = isLE ? 1 : -1
  var s = value < 0 || (value === 0 && 1 / value < 0) ? 1 : 0

  value = Math.abs(value)

  if (isNaN(value) || value === Infinity) {
    m = isNaN(value) ? 1 : 0
    e = eMax
  } else {
    e = Math.floor(Math.log(value) / Math.LN2)
    if (value * (c = Math.pow(2, -e)) < 1) {
      e--
      c *= 2
    }
    if (e + eBias >= 1) {
      value += rt / c
    } else {
      value += rt * Math.pow(2, 1 - eBias)
    }
    if (value * c >= 2) {
      e++
      c /= 2
    }

    if (e + eBias >= eMax) {
      m = 0
      e = eMax
    } else if (e + eBias >= 1) {
      m = ((value * c) - 1) * Math.pow(2, mLen)
      e = e + eBias
    } else {
      m = value * Math.pow(2, eBias - 1) * Math.pow(2, mLen)
      e = 0
    }
  }

  for (; mLen >= 8; buffer[offset + i] = m & 0xff, i += d, m /= 256, mLen -= 8) {}

  e = (e << mLen) | m
  eLen += mLen
  for (; eLen > 0; buffer[offset + i] = e & 0xff, i += d, e /= 256, eLen -= 8) {}

  buffer[offset + i - d] |= s * 128
}


/***/ },

/***/ "./node_modules/is-plain-object/dist/is-plain-object.js"
/*!**************************************************************!*\
  !*** ./node_modules/is-plain-object/dist/is-plain-object.js ***!
  \**************************************************************/
(__unused_webpack_module, exports) {

"use strict";


/*!
 * is-plain-object <https://github.com/jonschlinkert/is-plain-object>
 *
 * Copyright (c) 2014-2017, Jon Schlinkert.
 * Released under the MIT License.
 */

function isObject(o) {
  return Object.prototype.toString.call(o) === '[object Object]';
}

function isPlainObject(o) {
  var ctor,prot;

  if (isObject(o) === false) return false;

  // If has modified constructor
  ctor = o.constructor;
  if (ctor === undefined) return true;

  // If has modified prototype
  prot = ctor.prototype;
  if (isObject(prot) === false) return false;

  // If constructor does not have an Object-specific method
  if (prot.hasOwnProperty('isPrototypeOf') === false) {
    return false;
  }

  // Most likely a plain Object
  return true;
}

exports.isPlainObject = isPlainObject;


/***/ },

/***/ "./node_modules/isarray/index.js"
/*!***************************************!*\
  !*** ./node_modules/isarray/index.js ***!
  \***************************************/
(module) {

var toString = {}.toString;

module.exports = Array.isArray || function (arr) {
  return toString.call(arr) == '[object Array]';
};


/***/ },

/***/ "./node_modules/launder/index.js"
/*!***************************************!*\
  !*** ./node_modules/launder/index.js ***!
  \***************************************/
(module, __unused_webpack_exports, __webpack_require__) {

const dayjs = __webpack_require__(/*! dayjs */ "./node_modules/dayjs/dayjs.min.js");

// Strip characters browsers ignore inside URLs (control chars and
// embedded HTML comments) that are commonly used to sneak XSS
// payloads past simple scheme checks.
function cleanHref(href) {
  // Browsers ignore character codes of 32 (space) and below in a surprising
  // number of situations. Start reading here:
  // https://www.owasp.org/index.php/XSS_Filter_Evasion_Cheat_Sheet#Embedded_tab
  // eslint-disable-next-line no-control-regex
  href = href.replace(/[\x00-\x20]+/g, '');
  // Clobber any comments in URLs, which the browser might
  // interpret inside an XML data island, allowing
  // a javascript: URL to be snuck through
  while (true) {
    const firstIndex = href.indexOf('<!--');
    if (firstIndex === -1) {
      break;
    }
    const lastIndex = href.indexOf('-->', firstIndex + 4);
    if (lastIndex === -1) {
      break;
    }
    href = href.substring(0, firstIndex) + href.substring(lastIndex + 3);
  }
  return href;
}

// Returns true if `href` should be rejected as unsafe. Used to block
// `javascript:`, `data:` and other dangerous schemes both when
// validating URL fields and when sanitizing HTML attribute values.
//
// `options.allowedSchemes` is an array of permitted URL schemes
// (defaults to the schemes long permitted by `launder().url`).
// `options.allowProtocolRelative` controls whether protocol-relative
// URLs (e.g. `//example.com`) are permitted. Defaults to true.
function naughtyHref(href, options) {
  options = options || {};
  const allowedSchemes = options.allowedSchemes ||
    [ 'http', 'https', 'ftp', 'mailto', 'tel', 'sms' ];
  const allowProtocolRelative = (options.allowProtocolRelative !== false);
  if (typeof href !== 'string') {
    return false;
  }
  href = cleanHref(href);
  // Case insensitive so we don't get faked out by JAVASCRIPT #1
  // Allow more characters after the first so we don't get faked
  // out by certain schemes browsers accept
  const matches = href.match(/^([a-zA-Z][a-zA-Z0-9.\-+]*):/);
  if (!matches) {
    // Protocol-relative URL starting with any combination of '/' and '\'
    if (href.match(/^[/\\]{2}/)) {
      return !allowProtocolRelative;
    }
    // No scheme
    return false;
  }
  const scheme = matches[1].toLowerCase();
  return allowedSchemes.indexOf(scheme) === -1;
}

module.exports = function(options) {
  const self = {};
  self.options = options || {};

  self.filterTag = self.options.filterTag || function(tag) {
    tag = tag.trim();
    return tag.toLowerCase();
  };

  self.string = function(s, def) {
    if (typeof (s) !== 'string') {
      if ((typeof (s) === 'number') || (typeof (s) === 'boolean')) {
        s += '';
      } else {
        s = '';
      }
    }
    s = s.trim();
    if (def !== undefined) {
      if (s === '') {
        s = def;
      }
    }
    return s;
  };

  self.strings = function(strings) {
    if (!Array.isArray(strings)) {
      return [];
    }
    return strings.map(function(s) {
      return self.string(s);
    });
  };

  self.integer = function(i, def, min, max) {
    if (def === undefined) {
      def = 0;
    }
    if (typeof (i) === 'number') {
      i = Math.floor(i);
    } else {
      try {
        i = parseInt(i, 10);
        if (isNaN(i)) {
          i = def;
        }
      } catch (e) {
        i = def;
      }
    }
    if ((typeof (min) === 'number') && (i < min)) {
      i = min;
    }
    if ((typeof (max) === 'number') && (i > max)) {
      i = max;
    }
    return i;
  };

  self.padInteger = function(i, places) {
    let s = i + '';
    while (s.length < places) {
      s = '0' + s;
    }
    return s;
  };

  self.float = function(i, def, min, max) {
    if (def === undefined) {
      def = 0;
    }
    if (!(typeof (i) === 'number')) {
      try {
        i = parseFloat(i, 10);
        if (isNaN(i)) {
          i = def;
        }
      } catch (e) {
        i = def;
      }
    }
    if ((typeof (min) === 'number') && (i < min)) {
      i = min;
    }
    if ((typeof (max) === 'number') && (i > max)) {
      i = max;
    }
    return i;
  };

  self.naughtyHref = naughtyHref;

  self.url = function(s, def, httpsFix) {
    s = self.string(s, def);
    // Allow the default to be undefined, null, false, etc.
    if (s === def) {
      return s;
    }
    // Strip characters browsers ignore that are commonly used to
    // smuggle dangerous schemes past validation.
    s = cleanHref(s);
    // Reject naughty URLs (e.g. `javascript:`, `data:`) before fixUrl
    // runs. Otherwise fixUrl could mask such schemes by prepending
    // `https://` to anything containing a `.`, turning
    // `javascript:alert(document.domain)` into a syntactically odd
    // but accepted `https://...` URL.
    if (naughtyHref(s)) {
      return def;
    }
    s = fixUrl(s);
    if (s === null) {
      return def;
    }
    return s;

    function fixUrl(href) {
      if (href.match(/^(((https?|ftp):\/\/)|((mailto|tel|sms):)|#|([^/.]+)?\/|[^/.]+$)/)) {
        // All good - no change required
        return href;
      } else if (href.match(/^[^/.]+\.[^/.]+/)) {
        // Smells like a domain name. Educated guess: they left off http://
        const protocol = httpsFix ? 'https://' : 'http://';
        return protocol + href;
      } else {
        return null;
      }
    }// removed by dead control flow

  };

  self.select = function(s, choices, def) {
    s = self.string(s);
    if (!choices || !choices.length) {
      return def;
    }
    let choice;
    if (typeof (choices[0]) === 'object') {
      choice = choices.find(function(choice) {
        if ((choice.value === null) || (choice.value === undefined)) {
          // Don't crash on invalid choices
          return false;
        }
        return choice.value.toString() === s;
      });
      if (choice != null) {
        return choice.value;
      }
      return def;
    }
    choice = choices.find(function(choice) {
      if ((choice === null) || (choice === undefined)) {
        // Don't crash on invalid choices
        return false;
      }
      return choice.toString() === s;
    });
    if (choice !== undefined) {
      return choice;
    }
    return def;
  };

  self.boolean = function(b, def) {
    if (b === true) {
      return true;
    }
    if (b === false) {
      return false;
    }
    b = self.string(b, def);
    if (b === def) {
      if (b === undefined) {
        return false;
      }
      return b;
    }
    b = b.toLowerCase().charAt(0);
    if ((b === '') || (b === 'n') || (b === '0') || (b === 'f')) {
      return false;
    }
    if ((b === 't') || (b === 'y') || (b === '1')) {
      return true;
    }
    return false;
  };

  // Given an `options` object in which options[name] is a string
  // set to '0', '1', or 'any', this method adds mongodb criteria
  // to the `criteria` object.
  //
  // '0' or false means "the property must be false or absent," '1' or true
  // means "the property must be true," and 'any' or null means "we don't care
  // what the property is."
  //
  // See `booleanOrNull` for additional synonyms accepted for the
  // three possible values.
  //
  // An empty string is considered equivalent to '0'.
  //
  // This is not the same as apos.sanitizeBoolean which is concerned only with
  // true or false and does not address "any."
  //
  // `def` defaults to `any`.
  //
  // This method is most often used with REST API parameters and forms.

  self.addBooleanFilterToCriteria = function(options, name, criteria, def) {
    // if any or null, we aren't changing criteria
    if (def === undefined) {
      def = null;
    }

    // allow object or boolean
    let value = (typeof (options) === 'object' && options !== null) ? options[name] : options;
    value = (value === undefined) ? def : value;
    value = self.booleanOrNull(value);

    if (value === null) {
      // Don't care, show all
    } else if (!value) {
      // Must be absent or false. Hooray for $ne
      criteria[name] = { $ne: true };
    } else {
      // Must be true
      criteria[name] = true;
    }
  };

  // This method is used for tristate filters, i.e. "published,"
  // "unpublished", and "show me both".
  //
  // Accepts `true`, `false`, or `null` and returns them exactly
  // as such; if the parameter is none of those or their synonyms
  // below, returns `def`.
  //
  // Also accepts the strings `'yes'` (or starting with y), `'no'` (or
  // starting with n), `'true'` (or starting with t), `'false'`
  // (or starting with f), `'1'`, `'0'` and the strings `'any'` and
  // `'null'`. The string `'null'` must be an exact match, anything
  // else starting with `n` is taken as `no` (false).
  //
  // These various synonyms are useful for string input, such as from
  // a user friendly query string.

  self.booleanOrNull = function(b, def) {
    if (b === true) {
      return b;
    }
    if (b === false) {
      return b;
    }
    if (b === null) {
      return b;
    }

    b = self.string(b, def);
    if (b === def) {
      if (def === undefined) {
        return null;
      }
      return b;
    }

    // String 'null' must match as a full string to disambiguate from string 'n' for 'no'
    if (b === 'null') {
      return null;
    }

    b = b.toLowerCase().charAt(0);

    if ((b === '') || (b === 'n') || (b === '0') || (b === 'f')) {
      return false;
    }

    if ((b === 't') || (b === 'y') || (b === '1')) {
      return true;
    }

    if ((b === 'a')) {
      return null;
    }

    return def;
  };

  // Accept a user-entered string in YYYY-MM-DD, MM/DD, MM/DD/YY, or MM/DD/YYYY format
  // (tolerates missing leading zeroes on MM and DD). Also accepts a Date object.
  // Returns YYYY-MM-DD.
  //
  // The current year is assumed when MM/DD is used. If there is no explicit default
  // any unparseable date is returned as today's date.
  //
  // If the default is explicitly `null` (not `undefined`) then `null` is returned for
  // any unparseable date.
  //
  // The `now` argument can be passed for performance if you prefer to call
  // `new Date()` just once before many calls to this method and pass that single
  // value to all of them.

  self.date = function(date, def, now) {
    let components;

    function returnDefault() {
      if (def === undefined) {
        def = dayjs().format('YYYY-MM-DD');
      }
      return def;
    }

    if (typeof (date) === 'string') {
      if (date.match(/\//)) {
        components = date.split('/');
        if (components.length === 2) {
          // Convert mm/dd to yyyy-mm-dd
          return (now || new Date()).getFullYear() + '-' + self.padInteger(components[0], 2) + '-' + self.padInteger(components[1], 2);
        } else if (components.length === 3) {
          // Convert mm/dd/yy to mm/dd/yyyy
          if (components[2] < 100) {
            // Add the current century. If the result is more than
            // 50 years in the future, assume they meant the
            // previous century. Thus in 2015, we find that
            // we get the intuitive result for both 1/1/75,
            // 1/1/99 and 1/1/25. It's a nasty habit among
            // us imprecise humans. -Tom
            const d = (now || new Date());
            const nowYear = d.getFullYear() % 100;
            const nowCentury = d.getFullYear() - nowYear;
            let theirYear = parseInt(components[2]) + nowCentury;
            if (theirYear - d.getFullYear() > 50) {
              theirYear -= 100;
            }
            components[2] = theirYear;
          }
          // Convert mm/dd/yyyy to yyyy-mm-dd
          return self.padInteger(components[2], 4) + '-' + self.padInteger(components[0], 2) + '-' + self.padInteger(components[1], 2);
        } else {
          return returnDefault();
        }
      } else if (date.match(/-/)) {
        components = date.split('-');
        if (components.length === 2) {
          // Convert mm-dd to yyyy-mm-dd
          return (now || new Date()).getFullYear() + '-' + self.padInteger(components[0], 2) + '-' + self.padInteger(components[1], 2);
        } else if (components.length === 3) {
          // Convert yyyy-mm-dd (with questionable padding) to yyyy-mm-dd
          return self.padInteger(components[0], 4) + '-' + self.padInteger(components[1], 2) + '-' + self.padInteger(components[2], 2);
        } else {
          return returnDefault();
        }
      }
    }
    try {
      if (date === null) {
        return returnDefault();
      }
      date = (now || new Date(date));
      if (isNaN(date.getTime())) {
        return returnDefault();
      }
      return date.getFullYear() + '-' + self.padInteger(date.getMonth() + 1, 2) + '-' + self.padInteger(date.getDate(), 2);
    } catch (e) {
      return returnDefault();
    }
  };

  // This is likely not relevent to you unless you're using Apostrophe
  // Given a date object, return a date string in Apostrophe's preferred sortable,
  // comparable, JSON-able format, which is YYYY-MM-DD. If `date` is undefined
  // the current date is used.
  self.formatDate = function(date) {
    return dayjs(date).format('YYYY-MM-DD');
  };

  // Accepts a user-entered string in 12-hour or 24-hour time and returns a string
  // in 24-hour time. This method is tolerant of syntax such as `4pm`; minutes and
  // seconds are optional.
  //
  // If `def` is not set the default is the current time.

  self.time = function(time, def) {
    time = self.string(time).toLowerCase();
    time = time.trim();
    const components = time.match(/^(\d+)([:|.](\d+))?([:|.](\d+))?\s*(am|pm|AM|PM|a|p|A|M)?$/);
    if (components) {
      let hours = parseInt(components[1], 10);
      const minutes = (components[3] !== undefined) ? parseInt(components[3], 10) : 0;
      const seconds = (components[5] !== undefined) ? parseInt(components[5], 10) : 0;
      let ampm = (components[6]) ? components[6].toLowerCase() : components[6];
      ampm = ampm && ampm.charAt(0);
      if ((hours === 12) && (ampm === 'a')) {
        hours -= 12;
      } else if ((hours === 12) && (ampm === 'p')) {
        // Leave it be
      } else if (ampm === 'p') {
        hours += 12;
      }
      if ((hours === 24) || (hours === '24')) {
        hours = 0;
      }
      return self.padInteger(hours, 2) + ':' + self.padInteger(minutes, 2) + ':' + self.padInteger(seconds, 2);
    } else {
      if (def !== undefined) {
        return def;
      }
      return dayjs().format('HH:mm');
    }
  };

  // This is likely not relevent to you unless you're using Apostrophe
  // Given a JavaScript Date object, return a time string in
  // Apostrophe's preferred sortable, comparable, JSON-able format:
  // 24-hour time, with seconds.
  //
  // If `date` is missing the current time is used.

  self.formatTime = function(date) {
    return dayjs(date).format('HH:mm:ss');
  };

  // Sanitize tags. Tags should be submitted as an array of strings,
  // or a comma-separated string.
  //
  // This method ensures the input is an array or string and, if
  // an array, that the elements of the array are strings.
  //
  // If a filterTag function is passed as an option when initializing
  // Launder, then all tags are passed through it (as individual
  // strings, one per call) and the return value is used instead. You
  // may also pass a filterTag when calling this function

  self.tags = function(tags, filter) {
    if (typeof (tags) === 'string') {
      tags = tags.split(/,\s*/);
    }
    if (!Array.isArray(tags)) {
      return [];
    }
    const strings = tags.map(tag => self.string(tag));
    const rewritten = strings.map(filter || self.filterTag);
    const filtered = rewritten.filter(tag => tag.length > 0);
    return filtered;
  };

  // Sanitize an id. IDs must consist solely of upper and lower case
  // letters, numbers, and digits unless options.idRegExp is set.

  self.idRegExp = self.options.idRegExp || /^[A-Za-z0-9_]+$/;

  self.id = function(s, def) {
    const id = self.string(s, def);
    if (id === def) {
      return id;
    }
    if (!id.match(self.idRegExp)) {
      return def;
    }
    return id;
  };

  // Sanitize an array of IDs. IDs must consist solely of upper and lower case
  // letters and numbers, digits, and underscores. Any elements that are not
  // IDs are omitted from the final array.
  self.ids = function(ids) {
    if (!Array.isArray(ids)) {
      return [];
    }
    const result = ids.filter(function(id) {
      return (self.id(id) !== undefined);
    });
    return result;
  };
  return self;
};

// Expose `naughtyHref` statically so callers (notably sanitize-html)
// can use it without instantiating a launder.
module.exports.naughtyHref = naughtyHref;


/***/ },

/***/ "./node_modules/parse-srcset/src/parse-srcset.js"
/*!*******************************************************!*\
  !*** ./node_modules/parse-srcset/src/parse-srcset.js ***!
  \*******************************************************/
(module, exports) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/**
 * Srcset Parser
 *
 * By Alex Bell |  MIT License
 *
 * JS Parser for the string value that appears in markup <img srcset="here">
 *
 * @returns Array [{url: _, d: _, w: _, h:_}, ...]
 *
 * Based super duper closely on the reference algorithm at:
 * https://html.spec.whatwg.org/multipage/embedded-content.html#parse-a-srcset-attribute
 *
 * Most comments are copied in directly from the spec
 * (except for comments in parens).
 */

(function (root, factory) {
	if (true) {
		// AMD. Register as an anonymous module.
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else // removed by dead control flow
{}
}(this, function () {

	// 1. Let input be the value passed to this algorithm.
	return function (input) {

		// UTILITY FUNCTIONS

		// Manual is faster than RegEx
		// http://bjorn.tipling.com/state-and-regular-expressions-in-javascript
		// http://jsperf.com/whitespace-character/5
		function isSpace(c) {
			return (c === "\u0020" || // space
			c === "\u0009" || // horizontal tab
			c === "\u000A" || // new line
			c === "\u000C" || // form feed
			c === "\u000D");  // carriage return
		}

		function collectCharacters(regEx) {
			var chars,
				match = regEx.exec(input.substring(pos));
			if (match) {
				chars = match[ 0 ];
				pos += chars.length;
				return chars;
			}
		}

		var inputLength = input.length,

			// (Don't use \s, to avoid matching non-breaking space)
			regexLeadingSpaces = /^[ \t\n\r\u000c]+/,
			regexLeadingCommasOrSpaces = /^[, \t\n\r\u000c]+/,
			regexLeadingNotSpaces = /^[^ \t\n\r\u000c]+/,
			regexTrailingCommas = /[,]+$/,
			regexNonNegativeInteger = /^\d+$/,

			// ( Positive or negative or unsigned integers or decimals, without or without exponents.
			// Must include at least one digit.
			// According to spec tests any decimal point must be followed by a digit.
			// No leading plus sign is allowed.)
			// https://html.spec.whatwg.org/multipage/infrastructure.html#valid-floating-point-number
			regexFloatingPoint = /^-?(?:[0-9]+|[0-9]*\.[0-9]+)(?:[eE][+-]?[0-9]+)?$/,

			url,
			descriptors,
			currentDescriptor,
			state,
			c,

			// 2. Let position be a pointer into input, initially pointing at the start
			//    of the string.
			pos = 0,

			// 3. Let candidates be an initially empty source set.
			candidates = [];

		// 4. Splitting loop: Collect a sequence of characters that are space
		//    characters or U+002C COMMA characters. If any U+002C COMMA characters
		//    were collected, that is a parse error.
		while (true) {
			collectCharacters(regexLeadingCommasOrSpaces);

			// 5. If position is past the end of input, return candidates and abort these steps.
			if (pos >= inputLength) {
				return candidates; // (we're done, this is the sole return path)
			}

			// 6. Collect a sequence of characters that are not space characters,
			//    and let that be url.
			url = collectCharacters(regexLeadingNotSpaces);

			// 7. Let descriptors be a new empty list.
			descriptors = [];

			// 8. If url ends with a U+002C COMMA character (,), follow these substeps:
			//		(1). Remove all trailing U+002C COMMA characters from url. If this removed
			//         more than one character, that is a parse error.
			if (url.slice(-1) === ",") {
				url = url.replace(regexTrailingCommas, "");
				// (Jump ahead to step 9 to skip tokenization and just push the candidate).
				parseDescriptors();

				//	Otherwise, follow these substeps:
			} else {
				tokenize();
			} // (close else of step 8)

			// 16. Return to the step labeled splitting loop.
		} // (Close of big while loop.)

		/**
		 * Tokenizes descriptor properties prior to parsing
		 * Returns undefined.
		 */
		function tokenize() {

			// 8.1. Descriptor tokeniser: Skip whitespace
			collectCharacters(regexLeadingSpaces);

			// 8.2. Let current descriptor be the empty string.
			currentDescriptor = "";

			// 8.3. Let state be in descriptor.
			state = "in descriptor";

			while (true) {

				// 8.4. Let c be the character at position.
				c = input.charAt(pos);

				//  Do the following depending on the value of state.
				//  For the purpose of this step, "EOF" is a special character representing
				//  that position is past the end of input.

				// In descriptor
				if (state === "in descriptor") {
					// Do the following, depending on the value of c:

					// Space character
					// If current descriptor is not empty, append current descriptor to
					// descriptors and let current descriptor be the empty string.
					// Set state to after descriptor.
					if (isSpace(c)) {
						if (currentDescriptor) {
							descriptors.push(currentDescriptor);
							currentDescriptor = "";
							state = "after descriptor";
						}

						// U+002C COMMA (,)
						// Advance position to the next character in input. If current descriptor
						// is not empty, append current descriptor to descriptors. Jump to the step
						// labeled descriptor parser.
					} else if (c === ",") {
						pos += 1;
						if (currentDescriptor) {
							descriptors.push(currentDescriptor);
						}
						parseDescriptors();
						return;

						// U+0028 LEFT PARENTHESIS (()
						// Append c to current descriptor. Set state to in parens.
					} else if (c === "\u0028") {
						currentDescriptor = currentDescriptor + c;
						state = "in parens";

						// EOF
						// If current descriptor is not empty, append current descriptor to
						// descriptors. Jump to the step labeled descriptor parser.
					} else if (c === "") {
						if (currentDescriptor) {
							descriptors.push(currentDescriptor);
						}
						parseDescriptors();
						return;

						// Anything else
						// Append c to current descriptor.
					} else {
						currentDescriptor = currentDescriptor + c;
					}
					// (end "in descriptor"

					// In parens
				} else if (state === "in parens") {

					// U+0029 RIGHT PARENTHESIS ())
					// Append c to current descriptor. Set state to in descriptor.
					if (c === ")") {
						currentDescriptor = currentDescriptor + c;
						state = "in descriptor";

						// EOF
						// Append current descriptor to descriptors. Jump to the step labeled
						// descriptor parser.
					} else if (c === "") {
						descriptors.push(currentDescriptor);
						parseDescriptors();
						return;

						// Anything else
						// Append c to current descriptor.
					} else {
						currentDescriptor = currentDescriptor + c;
					}

					// After descriptor
				} else if (state === "after descriptor") {

					// Do the following, depending on the value of c:
					// Space character: Stay in this state.
					if (isSpace(c)) {

						// EOF: Jump to the step labeled descriptor parser.
					} else if (c === "") {
						parseDescriptors();
						return;

						// Anything else
						// Set state to in descriptor. Set position to the previous character in input.
					} else {
						state = "in descriptor";
						pos -= 1;

					}
				}

				// Advance position to the next character in input.
				pos += 1;

				// Repeat this step.
			} // (close while true loop)
		}

		/**
		 * Adds descriptor properties to a candidate, pushes to the candidates array
		 * @return undefined
		 */
		// Declared outside of the while loop so that it's only created once.
		function parseDescriptors() {

			// 9. Descriptor parser: Let error be no.
			var pError = false,

				// 10. Let width be absent.
				// 11. Let density be absent.
				// 12. Let future-compat-h be absent. (We're implementing it now as h)
				w, d, h, i,
				candidate = {},
				desc, lastChar, value, intVal, floatVal;

			// 13. For each descriptor in descriptors, run the appropriate set of steps
			// from the following list:
			for (i = 0 ; i < descriptors.length; i++) {
				desc = descriptors[ i ];

				lastChar = desc[ desc.length - 1 ];
				value = desc.substring(0, desc.length - 1);
				intVal = parseInt(value, 10);
				floatVal = parseFloat(value);

				// If the descriptor consists of a valid non-negative integer followed by
				// a U+0077 LATIN SMALL LETTER W character
				if (regexNonNegativeInteger.test(value) && (lastChar === "w")) {

					// If width and density are not both absent, then let error be yes.
					if (w || d) {pError = true;}

					// Apply the rules for parsing non-negative integers to the descriptor.
					// If the result is zero, let error be yes.
					// Otherwise, let width be the result.
					if (intVal === 0) {pError = true;} else {w = intVal;}

					// If the descriptor consists of a valid floating-point number followed by
					// a U+0078 LATIN SMALL LETTER X character
				} else if (regexFloatingPoint.test(value) && (lastChar === "x")) {

					// If width, density and future-compat-h are not all absent, then let error
					// be yes.
					if (w || d || h) {pError = true;}

					// Apply the rules for parsing floating-point number values to the descriptor.
					// If the result is less than zero, let error be yes. Otherwise, let density
					// be the result.
					if (floatVal < 0) {pError = true;} else {d = floatVal;}

					// If the descriptor consists of a valid non-negative integer followed by
					// a U+0068 LATIN SMALL LETTER H character
				} else if (regexNonNegativeInteger.test(value) && (lastChar === "h")) {

					// If height and density are not both absent, then let error be yes.
					if (h || d) {pError = true;}

					// Apply the rules for parsing non-negative integers to the descriptor.
					// If the result is zero, let error be yes. Otherwise, let future-compat-h
					// be the result.
					if (intVal === 0) {pError = true;} else {h = intVal;}

					// Anything else, Let error be yes.
				} else {pError = true;}
			} // (close step 13 for loop)

			// 15. If error is still no, then append a new image source to candidates whose
			// URL is url, associated with a width width if not absent and a pixel
			// density density if not absent. Otherwise, there is a parse error.
			if (!pError) {
				candidate.url = url;
				if (w) { candidate.w = w;}
				if (d) { candidate.d = d;}
				if (h) { candidate.h = h;}
				candidates.push(candidate);
			} else if (console && console.log) {
				console.log("Invalid srcset descriptor found in '" +
					input + "' at '" + desc + "'.");
			}
		} // (close parseDescriptors fn)

	}
}));


/***/ },

/***/ "./node_modules/picocolors/picocolors.browser.js"
/*!*******************************************************!*\
  !*** ./node_modules/picocolors/picocolors.browser.js ***!
  \*******************************************************/
(module) {

var x=String;
var create=function() {return {isColorSupported:false,reset:x,bold:x,dim:x,italic:x,underline:x,inverse:x,hidden:x,strikethrough:x,black:x,red:x,green:x,yellow:x,blue:x,magenta:x,cyan:x,white:x,gray:x,bgBlack:x,bgRed:x,bgGreen:x,bgYellow:x,bgBlue:x,bgMagenta:x,bgCyan:x,bgWhite:x,blackBright:x,redBright:x,greenBright:x,yellowBright:x,blueBright:x,magentaBright:x,cyanBright:x,whiteBright:x,bgBlackBright:x,bgRedBright:x,bgGreenBright:x,bgYellowBright:x,bgBlueBright:x,bgMagentaBright:x,bgCyanBright:x,bgWhiteBright:x}};
module.exports=create();
module.exports.createColors = create;


/***/ },

/***/ "./node_modules/postcss/lib/at-rule.js"
/*!*********************************************!*\
  !*** ./node_modules/postcss/lib/at-rule.js ***!
  \*********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Container = __webpack_require__(/*! ./container */ "./node_modules/postcss/lib/container.js")

class AtRule extends Container {
  constructor(defaults) {
    super(defaults)
    this.type = 'atrule'
  }

  append(...children) {
    if (!this.proxyOf.nodes) this.nodes = []
    return super.append(...children)
  }

  prepend(...children) {
    if (!this.proxyOf.nodes) this.nodes = []
    return super.prepend(...children)
  }
}

module.exports = AtRule
AtRule.default = AtRule

Container.registerAtRule(AtRule)


/***/ },

/***/ "./node_modules/postcss/lib/comment.js"
/*!*********************************************!*\
  !*** ./node_modules/postcss/lib/comment.js ***!
  \*********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Node = __webpack_require__(/*! ./node */ "./node_modules/postcss/lib/node.js")

class Comment extends Node {
  constructor(defaults) {
    super(defaults)
    this.type = 'comment'
  }
}

module.exports = Comment
Comment.default = Comment


/***/ },

/***/ "./node_modules/postcss/lib/container.js"
/*!***********************************************!*\
  !*** ./node_modules/postcss/lib/container.js ***!
  \***********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Comment = __webpack_require__(/*! ./comment */ "./node_modules/postcss/lib/comment.js")
let Declaration = __webpack_require__(/*! ./declaration */ "./node_modules/postcss/lib/declaration.js")
let Node = __webpack_require__(/*! ./node */ "./node_modules/postcss/lib/node.js")
let { isClean, my } = __webpack_require__(/*! ./symbols */ "./node_modules/postcss/lib/symbols.js")

let AtRule, parse, Root, Rule

function cleanSource(nodes) {
  let stack = nodes.slice()
  while (stack.length > 0) {
    let node = stack.pop()
    delete node.source
    if (node.nodes) {
      node.nodes = node.nodes.slice()
      for (let i of node.nodes) stack.push(i)
    }
  }
  return nodes.slice()
}

function markTreeDirty(node) {
  let stack = [node]
  while (stack.length > 0) {
    let next = stack.pop()
    next[isClean] = false
    if (next.proxyOf.nodes) {
      for (let i of next.proxyOf.nodes) stack.push(i)
    }
  }
}

class Container extends Node {
  get first() {
    if (!this.proxyOf.nodes) return undefined
    return this.proxyOf.nodes[0]
  }

  get last() {
    if (!this.proxyOf.nodes) return undefined
    return this.proxyOf.nodes[this.proxyOf.nodes.length - 1]
  }

  append(...children) {
    for (let child of children) {
      let nodes = this.normalize(child, this.last)
      for (let node of nodes) this.proxyOf.nodes.push(node)
    }

    this.markDirty()

    return this
  }

  cleanRaws(keepBetween) {
    let stack = [this]
    while (stack.length > 0) {
      let node = stack.pop()
      if (node !== this && node.cleanRaws !== Container.prototype.cleanRaws) {
        // Subclass with own logic; let it handle its subtree
        node.cleanRaws(keepBetween)
        continue
      }
      Node.prototype.cleanRaws.call(node, keepBetween)
      if (node.nodes) {
        for (let child of node.nodes) stack.push(child)
      }
    }
  }

  each(callback) {
    if (!this.proxyOf.nodes) return undefined
    let iterator = this.getIterator()

    let index, result
    while (this.indexes[iterator] < this.proxyOf.nodes.length) {
      index = this.indexes[iterator]
      result = callback(this.proxyOf.nodes[index], index)
      if (result === false) break

      this.indexes[iterator] += 1
    }

    delete this.indexes[iterator]
    return result
  }

  every(condition) {
    return this.nodes.every(condition)
  }

  getIterator() {
    if (!this.lastEach) this.lastEach = 0
    if (!this.indexes) this.indexes = {}

    this.lastEach += 1
    let iterator = this.lastEach
    this.indexes[iterator] = 0

    return iterator
  }

  getProxyProcessor() {
    return {
      get(node, prop) {
        if (prop === 'proxyOf') {
          return node
        } else if (!node[prop]) {
          return node[prop]
        } else if (
          prop === 'each' ||
          (typeof prop === 'string' && prop.startsWith('walk'))
        ) {
          return (...args) => {
            return node[prop](
              ...args.map(i => {
                if (typeof i === 'function') {
                  return (child, index) => i(child.toProxy(), index)
                } else {
                  return i
                }
              })
            )
          }
        } else if (prop === 'every' || prop === 'some') {
          return cb => {
            return node[prop]((child, ...other) =>
              cb(child.toProxy(), ...other)
            )
          }
        } else if (prop === 'root') {
          return () => node.root().toProxy()
        } else if (prop === 'nodes') {
          return node.nodes.map(i => i.toProxy())
        } else if (prop === 'first' || prop === 'last') {
          return node[prop].toProxy()
        } else {
          return node[prop]
        }
      },

      set(node, prop, value) {
        if (node[prop] === value) return true
        node[prop] = value
        if (prop === 'name' || prop === 'params' || prop === 'selector') {
          node.markDirty()
        }
        return true
      }
    }
  }

  index(child) {
    if (typeof child === 'number') return child
    if (child.proxyOf) child = child.proxyOf
    return this.proxyOf.nodes.indexOf(child)
  }

  insertAfter(exist, add) {
    let existIndex = this.index(exist)
    let nodes = this.normalize(add, this.proxyOf.nodes[existIndex]).reverse()
    existIndex = this.index(exist)
    for (let node of nodes) this.proxyOf.nodes.splice(existIndex + 1, 0, node)

    let index
    for (let id in this.indexes) {
      index = this.indexes[id]
      if (existIndex < index) {
        this.indexes[id] = index + nodes.length
      }
    }

    this.markDirty()

    return this
  }

  insertBefore(exist, add) {
    let existIndex = this.index(exist)
    let type = existIndex === 0 ? 'prepend' : false
    let nodes = this.normalize(
      add,
      this.proxyOf.nodes[existIndex],
      type
    ).reverse()
    existIndex = this.index(exist)
    for (let node of nodes) this.proxyOf.nodes.splice(existIndex, 0, node)

    let index
    for (let id in this.indexes) {
      index = this.indexes[id]
      if (existIndex <= index) {
        this.indexes[id] = index + nodes.length
      }
    }

    this.markDirty()

    return this
  }

  normalize(nodes, sample) {
    if (typeof nodes === 'string') {
      nodes = cleanSource(parse(nodes).nodes)
    } else if (typeof nodes === 'undefined') {
      nodes = []
    } else if (Array.isArray(nodes)) {
      nodes = nodes.slice(0)
      for (let i of nodes) {
        if (i.parent) i.parent.removeChild(i, 'ignore')
      }
    } else if (nodes.type === 'root' && this.type !== 'document') {
      nodes = nodes.nodes.slice(0)
      for (let i of nodes) {
        if (i.parent) i.parent.removeChild(i, 'ignore')
      }
    } else if (nodes.type) {
      nodes = [nodes]
    } else if (nodes.prop) {
      if (typeof nodes.value === 'undefined') {
        throw new Error('Value field is missed in node creation')
      } else if (typeof nodes.value !== 'string') {
        nodes.value = String(nodes.value)
      }
      nodes = [new Declaration(nodes)]
    } else if (nodes.selector || nodes.selectors) {
      nodes = [new Rule(nodes)]
    } else if (nodes.name) {
      nodes = [new AtRule(nodes)]
    } else if (nodes.text) {
      nodes = [new Comment(nodes)]
    } else {
      throw new Error('Unknown node type in node creation')
    }

    let processed = nodes.map(i => {
      /* c8 ignore next */
      if (!i[my]) Container.rebuild(i)
      i = i.proxyOf
      if (i.parent) i.parent.removeChild(i)
      if (i[isClean]) markTreeDirty(i)

      if (!i.raws) i.raws = {}
      if (typeof i.raws.before === 'undefined') {
        if (sample && typeof sample.raws.before !== 'undefined') {
          i.raws.before = sample.raws.before.replace(/\S/g, '')
        }
      }
      i.parent = this.proxyOf
      return i
    })

    return processed
  }

  prepend(...children) {
    children = children.reverse()
    for (let child of children) {
      let nodes = this.normalize(child, this.first, 'prepend').reverse()
      for (let node of nodes) this.proxyOf.nodes.unshift(node)
      for (let id in this.indexes) {
        this.indexes[id] = this.indexes[id] + nodes.length
      }
    }

    this.markDirty()

    return this
  }

  push(child) {
    child.parent = this
    this.proxyOf.nodes.push(child)
    return this
  }

  removeAll() {
    for (let node of this.proxyOf.nodes) node.parent = undefined
    this.proxyOf.nodes = []

    this.markDirty()

    return this
  }

  removeChild(child) {
    child = this.index(child)
    this.proxyOf.nodes[child].parent = undefined
    this.proxyOf.nodes.splice(child, 1)

    let index
    for (let id in this.indexes) {
      index = this.indexes[id]
      if (index >= child) {
        this.indexes[id] = index - 1
      }
    }

    this.markDirty()

    return this
  }

  replaceValues(pattern, opts, callback) {
    if (!callback) {
      callback = opts
      opts = {}
    }

    this.walkDecls(decl => {
      if (opts.props && !opts.props.includes(decl.prop)) return
      if (opts.fast && !decl.value.includes(opts.fast)) return

      decl.value = decl.value.replace(pattern, callback)
    })

    this.markDirty()

    return this
  }

  some(condition) {
    return this.nodes.some(condition)
  }

  walk(callback) {
    if (!this.proxyOf.nodes) return undefined

    // An explicit stack instead of recursive `each()` calls to survive
    // deeply nested trees. Each frame keeps a live `indexes` slot, so
    // insertion and removal during the walk behave like `each()`: the
    // slot stays at the current child until its subtree is finished.
    let stack = [{ iterator: this.getIterator(), node: this.proxyOf }]

    while (stack.length > 0) {
      let { iterator, node } = stack[stack.length - 1]
      let index = node.indexes[iterator]

      if (index >= node.proxyOf.nodes.length) {
        delete node.indexes[iterator]
        stack.pop()
        let parent = stack[stack.length - 1]
        // Finish the parent’s step for the child subtree we just left
        if (parent) parent.node.indexes[parent.iterator] += 1
        continue
      }

      let child = node.proxyOf.nodes[index]
      let result
      try {
        result = callback(child, index)
      } catch (e) {
        throw child.addToError(e)
      }
      if (result === false) {
        for (let opened of stack) {
          delete opened.node.indexes[opened.iterator]
        }
        return false
      }
      if (child.walk && child.proxyOf.nodes) {
        stack.push({ iterator: child.getIterator(), node: child })
      } else {
        node.indexes[iterator] += 1
      }
    }

    return undefined
  }

  walkAtRules(name, callback) {
    if (!callback) {
      callback = name
      return this.walk((child, i) => {
        if (child.type === 'atrule') {
          return callback(child, i)
        }
      })
    }
    if (name instanceof RegExp) {
      return this.walk((child, i) => {
        if (child.type === 'atrule' && name.test(child.name)) {
          return callback(child, i)
        }
      })
    }
    return this.walk((child, i) => {
      if (child.type === 'atrule' && child.name === name) {
        return callback(child, i)
      }
    })
  }

  walkComments(callback) {
    return this.walk((child, i) => {
      if (child.type === 'comment') {
        return callback(child, i)
      }
    })
  }

  walkDecls(prop, callback) {
    if (!callback) {
      callback = prop
      return this.walk((child, i) => {
        if (child.type === 'decl') {
          return callback(child, i)
        }
      })
    }
    if (prop instanceof RegExp) {
      return this.walk((child, i) => {
        if (child.type === 'decl' && prop.test(child.prop)) {
          return callback(child, i)
        }
      })
    }
    return this.walk((child, i) => {
      if (child.type === 'decl' && child.prop === prop) {
        return callback(child, i)
      }
    })
  }

  walkRules(selector, callback) {
    if (!callback) {
      callback = selector

      return this.walk((child, i) => {
        if (child.type === 'rule') {
          return callback(child, i)
        }
      })
    }
    if (selector instanceof RegExp) {
      return this.walk((child, i) => {
        if (child.type === 'rule' && selector.test(child.selector)) {
          return callback(child, i)
        }
      })
    }
    return this.walk((child, i) => {
      if (child.type === 'rule' && child.selector === selector) {
        return callback(child, i)
      }
    })
  }
}

Container.registerParse = dependant => {
  parse = dependant
}

Container.registerRule = dependant => {
  Rule = dependant
}

Container.registerAtRule = dependant => {
  AtRule = dependant
}

Container.registerRoot = dependant => {
  Root = dependant
}

module.exports = Container
Container.default = Container

/* c8 ignore start */
Container.rebuild = node => {
  let stack = [node]
  while (stack.length > 0) {
    let next = stack.pop()
    if (next.type === 'atrule') {
      Object.setPrototypeOf(next, AtRule.prototype)
    } else if (next.type === 'rule') {
      Object.setPrototypeOf(next, Rule.prototype)
    } else if (next.type === 'decl') {
      Object.setPrototypeOf(next, Declaration.prototype)
    } else if (next.type === 'comment') {
      Object.setPrototypeOf(next, Comment.prototype)
    } else if (next.type === 'root') {
      Object.setPrototypeOf(next, Root.prototype)
    }

    next[my] = true

    if (next.nodes) {
      for (let child of next.nodes) stack.push(child)
    }
  }
}
/* c8 ignore stop */


/***/ },

/***/ "./node_modules/postcss/lib/css-syntax-error.js"
/*!******************************************************!*\
  !*** ./node_modules/postcss/lib/css-syntax-error.js ***!
  \******************************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let pico = __webpack_require__(/*! picocolors */ "./node_modules/picocolors/picocolors.browser.js")

let terminalHighlight = __webpack_require__(/*! ./terminal-highlight */ "?fe98")

class CssSyntaxError extends Error {
  constructor(message, line, column, source, file, plugin) {
    super(message)
    this.name = 'CssSyntaxError'
    this.reason = message

    if (file) {
      this.file = file
    }
    if (source) {
      this.source = source
    }
    if (plugin) {
      this.plugin = plugin
    }
    if (typeof line !== 'undefined' && typeof column !== 'undefined') {
      if (typeof line === 'number') {
        this.line = line
        this.column = column
      } else {
        this.line = line.line
        this.column = line.column
        this.endLine = column.line
        this.endColumn = column.column
      }
    }

    this.setMessage()

    if (Error.captureStackTrace) {
      Error.captureStackTrace(this, CssSyntaxError)
    }
  }

  setMessage() {
    this.message = this.plugin ? this.plugin + ': ' : ''
    this.message += this.file ? this.file : '<css input>'
    if (typeof this.line !== 'undefined') {
      this.message += ':' + this.line + ':' + this.column
    }
    this.message += ': ' + this.reason
  }

  showSourceCode(color) {
    if (!this.source) return ''

    let css = this.source
    if (color == null) color = pico.isColorSupported

    let aside = text => text
    let mark = text => text
    let highlight = text => text
    if (color) {
      let { bold, gray, red } = pico.createColors(true)
      mark = text => bold(red(text))
      aside = text => gray(text)
      if (terminalHighlight) {
        highlight = text => terminalHighlight(text)
      }
    }

    let lines = css.split(/\r?\n/)
    let start = Math.max(this.line - 3, 0)
    let end = Math.min(this.line + 2, lines.length)
    let maxWidth = String(end).length

    return lines
      .slice(start, end)
      .map((line, index) => {
        let number = start + 1 + index
        let gutter = ' ' + (' ' + number).slice(-maxWidth) + ' | '
        if (number === this.line) {
          if (line.length > 160) {
            let padding = 20
            let subLineStart = Math.max(0, this.column - padding)
            let subLineEnd = Math.max(
              this.column + padding,
              this.endColumn + padding
            )
            let subLine = line.slice(subLineStart, subLineEnd)

            let spacing =
              aside(gutter.replace(/\d/g, ' ')) +
              line
                .slice(0, Math.min(this.column - 1, padding - 1))
                .replace(/[^\t]/g, ' ')

            return (
              mark('>') +
              aside(gutter) +
              highlight(subLine) +
              '\n ' +
              spacing +
              mark('^')
            )
          }

          let spacing =
            aside(gutter.replace(/\d/g, ' ')) +
            line.slice(0, this.column - 1).replace(/[^\t]/g, ' ')

          return (
            mark('>') +
            aside(gutter) +
            highlight(line) +
            '\n ' +
            spacing +
            mark('^')
          )
        }

        return ' ' + aside(gutter) + highlight(line)
      })
      .join('\n')
  }

  toString() {
    let code = this.showSourceCode()
    if (code) {
      code = '\n\n' + code + '\n'
    }
    return this.name + ': ' + this.message + code
  }
}

module.exports = CssSyntaxError
CssSyntaxError.default = CssSyntaxError


/***/ },

/***/ "./node_modules/postcss/lib/declaration.js"
/*!*************************************************!*\
  !*** ./node_modules/postcss/lib/declaration.js ***!
  \*************************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Node = __webpack_require__(/*! ./node */ "./node_modules/postcss/lib/node.js")

class Declaration extends Node {
  get variable() {
    return this.prop.startsWith('--') || this.prop[0] === '$'
  }

  constructor(defaults) {
    if (
      defaults &&
      typeof defaults.value !== 'undefined' &&
      typeof defaults.value !== 'string'
    ) {
      defaults = { ...defaults, value: String(defaults.value) }
    }
    super(defaults)
    this.type = 'decl'
  }
}

module.exports = Declaration
Declaration.default = Declaration


/***/ },

/***/ "./node_modules/postcss/lib/document.js"
/*!**********************************************!*\
  !*** ./node_modules/postcss/lib/document.js ***!
  \**********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Container = __webpack_require__(/*! ./container */ "./node_modules/postcss/lib/container.js")

let LazyResult, Processor

class Document extends Container {
  constructor(defaults) {
    // type needs to be passed to super, otherwise child roots won't be normalized correctly
    super({ type: 'document', ...defaults })

    if (!this.nodes) {
      this.nodes = []
    }
  }

  toResult(opts = {}) {
    let lazy = new LazyResult(new Processor(), this, opts)

    return lazy.stringify()
  }
}

Document.registerLazyResult = dependant => {
  LazyResult = dependant
}

Document.registerProcessor = dependant => {
  Processor = dependant
}

module.exports = Document
Document.default = Document


/***/ },

/***/ "./node_modules/postcss/lib/fromJSON.js"
/*!**********************************************!*\
  !*** ./node_modules/postcss/lib/fromJSON.js ***!
  \**********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let AtRule = __webpack_require__(/*! ./at-rule */ "./node_modules/postcss/lib/at-rule.js")
let Comment = __webpack_require__(/*! ./comment */ "./node_modules/postcss/lib/comment.js")
let Declaration = __webpack_require__(/*! ./declaration */ "./node_modules/postcss/lib/declaration.js")
let Input = __webpack_require__(/*! ./input */ "./node_modules/postcss/lib/input.js")
let PreviousMap = __webpack_require__(/*! ./previous-map */ "./node_modules/postcss/lib/previous-map.js")
let Root = __webpack_require__(/*! ./root */ "./node_modules/postcss/lib/root.js")
let Rule = __webpack_require__(/*! ./rule */ "./node_modules/postcss/lib/rule.js")

function hydrateInputs(json, inputs) {
  if (!json.inputs) return inputs
  return json.inputs.map(input => {
    let inputHydrated = { ...input, __proto__: Input.prototype }
    if (inputHydrated.map) {
      inputHydrated.map = {
        ...inputHydrated.map,
        __proto__: PreviousMap.prototype
      }
    }
    return inputHydrated
  })
}

function constructNode(json, inputs, children) {
  let defaults = { ...json }
  delete defaults.inputs
  delete defaults.nodes
  if (defaults.source) {
    let { inputId, ...source } = defaults.source
    defaults.source = source
    if (inputId != null) {
      defaults.source.input = inputs[inputId]
    }
  }

  let node
  if (defaults.type === 'root') {
    node = new Root(defaults)
  } else if (defaults.type === 'decl') {
    node = new Declaration(defaults)
  } else if (defaults.type === 'rule') {
    node = new Rule(defaults)
  } else if (defaults.type === 'comment') {
    node = new Comment(defaults)
  } else if (defaults.type === 'atrule') {
    node = new AtRule(defaults)
  } else {
    throw new Error('Unknown node type: ' + json.type)
  }

  // Rehydrated children are attached after construction. Passing them
  // through the container constructor would re-run insertion spacing
  // normalization and overwrite each child's own `raws.before`.
  if (children) {
    node.nodes = children
    for (let child of children) child.parent = node
  }

  return node
}

function fromJSON(json, inputs) {
  if (Array.isArray(json)) return json.map(n => fromJSON(n))

  // An explicit stack instead of recursive calls to survive deeply
  // nested trees. Children are rehydrated before their parent node
  // is constructed.
  let result
  let stack = [
    { childIndex: 0, children: [], inputs: hydrateInputs(json, inputs), json }
  ]

  while (stack.length > 0) {
    let frame = stack[stack.length - 1]
    let jsonNodes = frame.json.nodes

    if (jsonNodes && frame.childIndex < jsonNodes.length) {
      let childJson = jsonNodes[frame.childIndex]
      frame.childIndex += 1
      stack.push({
        childIndex: 0,
        children: [],
        inputs: hydrateInputs(childJson, frame.inputs),
        json: childJson
      })
      continue
    }

    stack.pop()
    let node = constructNode(
      frame.json,
      frame.inputs,
      jsonNodes ? frame.children : undefined
    )
    if (stack.length > 0) {
      stack[stack.length - 1].children.push(node)
    } else {
      result = node
    }
  }

  return result
}

module.exports = fromJSON
fromJSON.default = fromJSON


/***/ },

/***/ "./node_modules/postcss/lib/input.js"
/*!*******************************************!*\
  !*** ./node_modules/postcss/lib/input.js ***!
  \*******************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let { nanoid } = __webpack_require__(/*! nanoid/non-secure */ "./node_modules/nanoid/non-secure/index.cjs")
let { isAbsolute, resolve } = __webpack_require__(/*! path */ "?25fb")
let { SourceMapConsumer, SourceMapGenerator } = __webpack_require__(/*! source-map-js */ "?6f78")
let { fileURLToPath, pathToFileURL } = __webpack_require__(/*! url */ "?9214")

let CssSyntaxError = __webpack_require__(/*! ./css-syntax-error */ "./node_modules/postcss/lib/css-syntax-error.js")
let PreviousMap = __webpack_require__(/*! ./previous-map */ "./node_modules/postcss/lib/previous-map.js")
let terminalHighlight = __webpack_require__(/*! ./terminal-highlight */ "?fe98")

let lineToIndexCache = Symbol('lineToIndexCache')

let sourceMapAvailable = Boolean(SourceMapConsumer && SourceMapGenerator)
let pathAvailable = Boolean(resolve && isAbsolute)

function getLineToIndex(input) {
  if (input[lineToIndexCache]) return input[lineToIndexCache]
  let lines = input.css.split('\n')
  let lineToIndex = new Array(lines.length)
  let prevIndex = 0

  for (let i = 0, l = lines.length; i < l; i++) {
    lineToIndex[i] = prevIndex
    prevIndex += lines[i].length + 1
  }

  input[lineToIndexCache] = lineToIndex
  return lineToIndex
}

class Input {
  get from() {
    return this.file || this.id
  }

  constructor(css, opts = {}) {
    if (
      css === null ||
      typeof css === 'undefined' ||
      (typeof css === 'object' && !css.toString)
    ) {
      throw new Error(`PostCSS received ${css} instead of CSS string`)
    }

    this.css = css.toString()

    if (this.css[0] === '\uFEFF' || this.css[0] === '\uFFFE') {
      this.hasBOM = true
      this.css = this.css.slice(1)
    } else {
      this.hasBOM = false
    }

    this.document = this.css
    if (opts.document) this.document = opts.document.toString()

    if (opts.from) {
      if (
        !pathAvailable ||
        /^\w+:\/\//.test(opts.from) ||
        isAbsolute(opts.from)
      ) {
        this.file = opts.from
      } else {
        this.file = resolve(opts.from)
      }
    }

    if (pathAvailable && sourceMapAvailable) {
      let map = new PreviousMap(this.css, opts)
      if (map.text) {
        this.map = map
        let file = map.consumer().file
        if (!this.file && file) this.file = this.mapResolve(file)
      }
    }

    if (!this.file) {
      this.id = '<input css ' + nanoid(6) + '>'
    }
    if (this.map) this.map.file = this.from
  }

  error(message, line, column, opts = {}) {
    let endColumn, endLine, endOffset, offset, result

    if (line && typeof line === 'object') {
      let start = line
      let end = column
      if (typeof start.offset === 'number') {
        offset = start.offset
        let pos = this.fromOffset(offset)
        line = pos.line
        column = pos.col
      } else {
        line = start.line
        column = start.column
        offset = this.fromLineAndColumn(line, column)
      }
      if (typeof end.offset === 'number') {
        endOffset = end.offset
        let pos = this.fromOffset(endOffset)
        endLine = pos.line
        endColumn = pos.col
      } else {
        endLine = end.line
        endColumn = end.column
        endOffset = this.fromLineAndColumn(end.line, end.column)
      }
    } else if (!column) {
      offset = line
      let pos = this.fromOffset(offset)
      line = pos.line
      column = pos.col
    } else {
      offset = this.fromLineAndColumn(line, column)
    }

    let origin = this.origin(line, column, endLine, endColumn)
    if (origin) {
      result = new CssSyntaxError(
        message,
        origin.endLine === undefined
          ? origin.line
          : { column: origin.column, line: origin.line },
        origin.endLine === undefined
          ? origin.column
          : { column: origin.endColumn, line: origin.endLine },
        origin.source,
        origin.file,
        opts.plugin
      )
    } else {
      result = new CssSyntaxError(
        message,
        endLine === undefined ? line : { column, line },
        endLine === undefined ? column : { column: endColumn, line: endLine },
        this.css,
        this.file,
        opts.plugin
      )
    }

    result.input = {
      column,
      endColumn,
      endLine,
      endOffset,
      line,
      offset,
      source: this.css
    }
    if (this.file) {
      if (pathToFileURL) {
        result.input.url = pathToFileURL(this.file).toString()
      }
      result.input.file = this.file
    }

    return result
  }

  fromLineAndColumn(line, column) {
    let lineToIndex = getLineToIndex(this)
    let index = lineToIndex[line - 1]
    return index + column - 1
  }

  fromOffset(offset) {
    let lineToIndex = getLineToIndex(this)
    let lastLine = lineToIndex[lineToIndex.length - 1]

    let min = 0
    if (offset >= lastLine) {
      min = lineToIndex.length - 1
    } else {
      let max = lineToIndex.length - 2
      let mid
      while (min < max) {
        mid = min + ((max - min) >> 1)
        if (offset < lineToIndex[mid]) {
          max = mid - 1
        } else if (offset >= lineToIndex[mid + 1]) {
          min = mid + 1
        } else {
          min = mid
          break
        }
      }
    }
    return {
      col: offset - lineToIndex[min] + 1,
      line: min + 1
    }
  }

  mapResolve(file) {
    if (/^\w+:\/\//.test(file)) {
      return file
    }
    return resolve(this.map.consumer().sourceRoot || this.map.root || '.', file)
  }

  origin(line, column, endLine, endColumn) {
    if (!this.map) return false
    let consumer = this.map.consumer()

    let from = consumer.originalPositionFor({ column: column - 1, line })
    if (!from.source) return false

    let to
    if (typeof endLine === 'number') {
      let toPosition = consumer.originalPositionFor({
        column: endColumn - 1,
        line: endLine
      })
      // The source map may not have a mapping that covers the end position
      // (`originalPositionFor()` then returns `null` for `line`/`column`
      // instead of omitting them). Treat that the same as not requesting
      // an end position at all, so `endLine`/`endColumn` stay a consistent
      // `undefined` pair instead of a mix of `null` and a bogus number.
      if (toPosition.source) to = toPosition
    }

    let fromUrl

    if (isAbsolute(from.source)) {
      fromUrl = pathToFileURL(from.source)
    } else {
      fromUrl = new URL(
        from.source,
        this.map.consumer().sourceRoot || pathToFileURL(this.map.mapFile)
      )
    }

    let result = {
      column: from.column + 1,
      endColumn: to && to.column + 1,
      endLine: to && to.line,
      line: from.line,
      url: fromUrl.toString()
    }

    if (fromUrl.protocol === 'file:') {
      if (fileURLToPath) {
        result.file = fileURLToPath(fromUrl)
      } else {
        /* c8 ignore next 2 */
        throw new Error(`file: protocol is not available in this PostCSS build`)
      }
    }

    let source = consumer.sourceContentFor(from.source)
    if (source) result.source = source

    return result
  }

  toJSON() {
    let json = {}
    for (let name of ['hasBOM', 'css', 'file', 'id']) {
      if (this[name] != null) {
        json[name] = this[name]
      }
    }
    if (this.map) {
      json.map = { ...this.map }
      if (json.map.consumerCache) {
        json.map.consumerCache = undefined
      }
    }
    return json
  }
}

module.exports = Input
Input.default = Input

if (terminalHighlight && terminalHighlight.registerInput) {
  terminalHighlight.registerInput(Input)
}


/***/ },

/***/ "./node_modules/postcss/lib/lazy-result.js"
/*!*************************************************!*\
  !*** ./node_modules/postcss/lib/lazy-result.js ***!
  \*************************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Container = __webpack_require__(/*! ./container */ "./node_modules/postcss/lib/container.js")
let Document = __webpack_require__(/*! ./document */ "./node_modules/postcss/lib/document.js")
let MapGenerator = __webpack_require__(/*! ./map-generator */ "./node_modules/postcss/lib/map-generator.js")
let parse = __webpack_require__(/*! ./parse */ "./node_modules/postcss/lib/parse.js")
let Result = __webpack_require__(/*! ./result */ "./node_modules/postcss/lib/result.js")
let Root = __webpack_require__(/*! ./root */ "./node_modules/postcss/lib/root.js")
let stringify = __webpack_require__(/*! ./stringify */ "./node_modules/postcss/lib/stringify.js")
let { isClean, my } = __webpack_require__(/*! ./symbols */ "./node_modules/postcss/lib/symbols.js")
let warnOnce = __webpack_require__(/*! ./warn-once */ "./node_modules/postcss/lib/warn-once.js")

const TYPE_TO_CLASS_NAME = {
  atrule: 'AtRule',
  comment: 'Comment',
  decl: 'Declaration',
  document: 'Document',
  root: 'Root',
  rule: 'Rule'
}

const PLUGIN_PROPS = {
  AtRule: true,
  AtRuleExit: true,
  Comment: true,
  CommentExit: true,
  Declaration: true,
  DeclarationExit: true,
  Document: true,
  DocumentExit: true,
  Once: true,
  OnceExit: true,
  postcssPlugin: true,
  prepare: true,
  Root: true,
  RootExit: true,
  Rule: true,
  RuleExit: true
}

const NOT_VISITORS = {
  Once: true,
  postcssPlugin: true,
  prepare: true
}

const CHILDREN = 0

function isPromise(obj) {
  return typeof obj === 'object' && typeof obj.then === 'function'
}

function getEvents(node) {
  let key = false
  let type = TYPE_TO_CLASS_NAME[node.type]
  if (node.type === 'decl') {
    key = node.prop.toLowerCase()
  } else if (node.type === 'atrule') {
    key = node.name.toLowerCase()
  }

  if (key && node.append) {
    return [
      type,
      type + '-' + key,
      CHILDREN,
      type + 'Exit',
      type + 'Exit-' + key
    ]
  } else if (key) {
    return [type, type + '-' + key, type + 'Exit', type + 'Exit-' + key]
  } else if (node.append) {
    return [type, CHILDREN, type + 'Exit']
  } else {
    return [type, type + 'Exit']
  }
}

function toStack(node) {
  let events
  if (node.type === 'document') {
    events = ['Document', CHILDREN, 'DocumentExit']
  } else if (node.type === 'root') {
    events = ['Root', CHILDREN, 'RootExit']
  } else {
    events = getEvents(node)
  }

  return {
    eventIndex: 0,
    events,
    iterator: 0,
    node,
    visitorIndex: 0,
    visitors: []
  }
}

function cleanMarks(node) {
  let stack = [node]
  while (stack.length > 0) {
    let next = stack.pop()
    next[isClean] = false
    if (next.nodes) {
      for (let i of next.nodes) stack.push(i)
    }
  }
  return node
}

let postcss = {}

class LazyResult {
  get content() {
    return this.stringify().content
  }

  get css() {
    return this.stringify().css
  }

  get map() {
    return this.stringify().map
  }

  get messages() {
    return this.sync().messages
  }

  get opts() {
    return this.result.opts
  }

  get processor() {
    return this.result.processor
  }

  get root() {
    return this.sync().root
  }

  get [Symbol.toStringTag]() {
    return 'LazyResult'
  }

  constructor(processor, css, opts) {
    this.stringified = false
    this.processed = false

    let root
    if (
      typeof css === 'object' &&
      css !== null &&
      (css.type === 'root' || css.type === 'document')
    ) {
      root = cleanMarks(css)
    } else if (css instanceof LazyResult || css instanceof Result) {
      root = cleanMarks(css.root)
      if (css.map) {
        if (typeof opts.map === 'undefined') opts.map = {}
        if (!opts.map.inline) opts.map.inline = false
        opts.map.prev = css.map
      }
    } else {
      let parser = parse
      if (opts.syntax) parser = opts.syntax.parse
      if (opts.parser) parser = opts.parser
      if (parser.parse) parser = parser.parse

      try {
        root = parser(css, opts)
      } catch (error) {
        this.processed = true
        this.error = error
      }

      if (root && !root[my]) {
        /* c8 ignore next 2 */
        Container.rebuild(root)
      }
    }

    this.result = new Result(processor, root, opts)
    this.helpers = { ...postcss, postcss, result: this.result }
    this.plugins = this.processor.plugins.map(plugin => {
      if (typeof plugin === 'object' && plugin.prepare) {
        return { ...plugin, ...plugin.prepare(this.result) }
      } else {
        return plugin
      }
    })
  }

  async() {
    if (this.error) return Promise.reject(this.error)
    if (this.processed) return Promise.resolve(this.result)
    if (!this.processing) {
      this.processing = this.runAsync()
    }
    return this.processing
  }

  catch(onRejected) {
    return this.async().catch(onRejected)
  }

  finally(onFinally) {
    return this.async().then(onFinally, onFinally)
  }

  getAsyncError() {
    throw new Error('Use process(css).then(cb) to work with async plugins')
  }

  handleError(error, node) {
    let plugin = this.result.lastPlugin
    try {
      if (node) node.addToError(error)
      this.error = error
      if (error.name === 'CssSyntaxError' && !error.plugin) {
        error.plugin = plugin.postcssPlugin
        error.setMessage()
      } else if (plugin.postcssVersion) {
        if (true) {
          let pluginName = plugin.postcssPlugin
          let pluginVer = plugin.postcssVersion
          let runtimeVer = this.result.processor.version
          let a = pluginVer.split('.')
          let b = runtimeVer.split('.')

          if (a[0] !== b[0] || parseInt(a[1]) > parseInt(b[1])) {
            // eslint-disable-next-line no-console
            console.error(
              'Unknown error from PostCSS plugin. Your current PostCSS ' +
                'version is ' +
                runtimeVer +
                ', but ' +
                pluginName +
                ' uses ' +
                pluginVer +
                '. Perhaps this is the source of the error below.'
            )
          }
        }
      }
    } catch (err) {
      /* c8 ignore next 3 */
      // eslint-disable-next-line no-console
      if (console && console.error) console.error(err)
    }
    return error
  }

  prepareVisitors() {
    this.listeners = {}
    let add = (plugin, type, cb) => {
      if (!this.listeners[type]) this.listeners[type] = []
      this.listeners[type].push([plugin, cb])
    }
    for (let plugin of this.plugins) {
      if (typeof plugin === 'object') {
        for (let event in plugin) {
          if (!PLUGIN_PROPS[event] && /^[A-Z]/.test(event)) {
            throw new Error(
              `Unknown event ${event} in ${plugin.postcssPlugin}. ` +
                `Try to update PostCSS (${this.processor.version} now).`
            )
          }
          if (!NOT_VISITORS[event]) {
            if (typeof plugin[event] === 'object') {
              for (let filter in plugin[event]) {
                if (filter === '*') {
                  add(plugin, event, plugin[event][filter])
                } else {
                  add(
                    plugin,
                    event + '-' + filter.toLowerCase(),
                    plugin[event][filter]
                  )
                }
              }
            } else if (typeof plugin[event] === 'function') {
              add(plugin, event, plugin[event])
            }
          }
        }
      }
    }
    this.hasListener = Object.keys(this.listeners).length > 0
  }

  async runAsync() {
    this.plugin = 0
    for (let i = 0; i < this.plugins.length; i++) {
      let plugin = this.plugins[i]
      let promise = this.runOnRoot(plugin)
      if (isPromise(promise)) {
        try {
          await promise
        } catch (error) {
          throw this.handleError(error)
        }
      }
    }

    this.prepareVisitors()
    if (this.hasListener) {
      let root = this.result.root
      while (!root[isClean]) {
        root[isClean] = true
        let stack = [toStack(root)]
        while (stack.length > 0) {
          let promise = this.visitTick(stack)
          if (isPromise(promise)) {
            try {
              await promise
            } catch (e) {
              let node = stack[stack.length - 1].node
              throw this.handleError(e, node)
            }
          }
        }
      }

      if (this.listeners.OnceExit) {
        for (let [plugin, visitor] of this.listeners.OnceExit) {
          this.result.lastPlugin = plugin
          try {
            if (root.type === 'document') {
              let roots = root.nodes.map(subRoot =>
                visitor(subRoot, this.helpers)
              )

              await Promise.all(roots)
            } else {
              await visitor(root, this.helpers)
            }
          } catch (e) {
            throw this.handleError(e)
          }
        }
      }
    }

    this.processed = true
    return this.stringify()
  }

  runOnRoot(plugin) {
    this.result.lastPlugin = plugin
    try {
      if (typeof plugin === 'object' && plugin.Once) {
        if (this.result.root.type === 'document') {
          let roots = this.result.root.nodes.map(root =>
            plugin.Once(root, this.helpers)
          )

          if (isPromise(roots[0])) {
            return Promise.all(roots)
          }

          return roots
        }

        return plugin.Once(this.result.root, this.helpers)
      } else if (typeof plugin === 'function') {
        return plugin(this.result.root, this.result)
      }
    } catch (error) {
      throw this.handleError(error)
    }
  }

  stringify() {
    if (this.error) throw this.error
    if (this.stringified) return this.result
    this.stringified = true

    this.sync()

    let opts = this.result.opts
    let str = stringify
    if (opts.syntax) str = opts.syntax.stringify
    if (opts.stringifier) str = opts.stringifier
    if (str.stringify) str = str.stringify

    let rootSource = this.result.root.source
    if (
      opts.map === undefined &&
      !(rootSource && rootSource.input && rootSource.input.map)
    ) {
      let result = ''
      str(this.result.root, i => {
        result += i
      })
      this.result.css = result
      return this.result
    }

    let map = new MapGenerator(str, this.result.root, this.result.opts)
    let data = map.generate()
    this.result.css = data[0]
    this.result.map = data[1]

    return this.result
  }

  sync() {
    if (this.error) throw this.error
    if (this.processed) return this.result
    this.processed = true

    if (this.processing) {
      throw this.getAsyncError()
    }

    for (let plugin of this.plugins) {
      let promise = this.runOnRoot(plugin)
      if (isPromise(promise)) {
        throw this.getAsyncError()
      }
    }

    this.prepareVisitors()
    if (this.hasListener) {
      let root = this.result.root
      while (!root[isClean]) {
        root[isClean] = true
        this.walkSync(root)
      }
      if (this.listeners.OnceExit) {
        if (root.type === 'document') {
          for (let subRoot of root.nodes) {
            this.visitSync(this.listeners.OnceExit, subRoot)
          }
        } else {
          this.visitSync(this.listeners.OnceExit, root)
        }
      }
    }

    return this.result
  }

  then(onFulfilled, onRejected) {
    if (true) {
      if (!('from' in this.opts)) {
        warnOnce(
          'Without `from` option PostCSS could generate wrong source map ' +
            'and will not find Browserslist config. Set it to CSS file path ' +
            'or to `undefined` to prevent this warning.'
        )
      }
    }
    return this.async().then(onFulfilled, onRejected)
  }

  toString() {
    return this.css
  }

  visitSync(visitors, node) {
    for (let [plugin, visitor] of visitors) {
      this.result.lastPlugin = plugin
      let promise
      try {
        promise = visitor(node, this.helpers)
      } catch (e) {
        throw this.handleError(e, node.proxyOf)
      }
      if (node.type !== 'root' && node.type !== 'document' && !node.parent) {
        return true
      }
      if (isPromise(promise)) {
        throw this.getAsyncError()
      }
    }
  }

  visitTick(stack) {
    let visit = stack[stack.length - 1]
    let { node, visitors } = visit

    if (node.type !== 'root' && node.type !== 'document' && !node.parent) {
      stack.pop()
      return
    }

    if (visitors.length > 0 && visit.visitorIndex < visitors.length) {
      let [plugin, visitor] = visitors[visit.visitorIndex]
      visit.visitorIndex += 1
      if (visit.visitorIndex === visitors.length) {
        visit.visitors = []
        visit.visitorIndex = 0
      }
      this.result.lastPlugin = plugin
      try {
        return visitor(node.toProxy(), this.helpers)
      } catch (e) {
        throw this.handleError(e, node)
      }
    }

    if (visit.iterator !== 0) {
      let iterator = visit.iterator
      // Advance past the child we just finished visiting. Like
      // `Container#each`, the index is incremented only after a child has
      // been fully processed, so a node inserted right after the current
      // child is not skipped by the `existIndex < index` adjustment in
      // `Container#insertAfter()` (which would fire exit events too early).
      if (visit.descending) {
        visit.descending = false
        node.indexes[iterator] += 1
      }
      let child
      while ((child = node.nodes[node.indexes[iterator]])) {
        if (!child[isClean]) {
          child[isClean] = true
          visit.descending = true
          stack.push(toStack(child))
          return
        }
        node.indexes[iterator] += 1
      }
      visit.iterator = 0
      delete node.indexes[iterator]
    }

    let events = visit.events
    while (visit.eventIndex < events.length) {
      let event = events[visit.eventIndex]
      visit.eventIndex += 1
      if (event === CHILDREN) {
        if (node.nodes && node.nodes.length) {
          node[isClean] = true
          visit.iterator = node.getIterator()
        }
        return
      } else if (this.listeners[event]) {
        visit.visitors = this.listeners[event]
        return
      }
    }
    stack.pop()
  }

  walkSync(node) {
    // An explicit stack like in async `visitTick()` to survive deeply
    // nested trees. Unlike `visitTick()`, nodes are marked clean only
    // on entering, so a node dirtied by its own visitors is revisited
    // on the next pass.
    node[isClean] = true
    let stack = [{ eventIndex: 0, events: getEvents(node), iterator: 0, node }]

    while (stack.length > 0) {
      let visit = stack[stack.length - 1]
      let visitNode = visit.node

      if (visit.iterator !== 0) {
        let iterator = visit.iterator
        // Advance past the child we just finished visiting. Like
        // `Container#each`, the index is incremented only after a child has
        // been fully processed. Incrementing before (as this loop used to)
        // makes a node inserted right after the current child get skipped by
        // the `existIndex < index` adjustment in `Container#insertAfter()`,
        // which fires exit events before those new siblings are visited.
        if (visit.descending) {
          visit.descending = false
          visitNode.indexes[iterator] += 1
        }
        let child
        let descended = false
        while ((child = visitNode.nodes[visitNode.indexes[iterator]])) {
          if (!child[isClean]) {
            child[isClean] = true
            visit.descending = true
            stack.push({
              eventIndex: 0,
              events: getEvents(child),
              iterator: 0,
              node: child
            })
            descended = true
            break
          }
          visitNode.indexes[iterator] += 1
        }
        if (descended) continue
        visit.iterator = 0
        delete visitNode.indexes[iterator]
      }

      if (visit.eventIndex < visit.events.length) {
        let event = visit.events[visit.eventIndex]
        visit.eventIndex += 1
        if (event === CHILDREN) {
          if (visitNode.nodes && visitNode.nodes.length) {
            visit.iterator = visitNode.getIterator()
          }
        } else {
          let visitors = this.listeners[event]
          if (visitors) {
            if (this.visitSync(visitors, visitNode.toProxy())) stack.pop()
          }
        }
        continue
      }

      stack.pop()
    }
  }

  warnings() {
    return this.sync().warnings()
  }
}

LazyResult.registerPostcss = dependant => {
  postcss = dependant
}

module.exports = LazyResult
LazyResult.default = LazyResult

Root.registerLazyResult(LazyResult)
Document.registerLazyResult(LazyResult)


/***/ },

/***/ "./node_modules/postcss/lib/list.js"
/*!******************************************!*\
  !*** ./node_modules/postcss/lib/list.js ***!
  \******************************************/
(module) {

"use strict";


let list = {
  comma(string) {
    return list.split(string, [','], true)
  },

  space(string) {
    let spaces = [' ', '\n', '\t']
    return list.split(string, spaces)
  },

  split(string, separators, last) {
    if (typeof string !== 'string') return []
    let array = []
    let current = ''
    let split = false

    let func = 0
    let inQuote = false
    let prevQuote = ''
    let escape = false
    let inComment = false

    for (let i = 0; i < string.length; i++) {
      let letter = string[i]

      if (inComment) {
        current += letter
        if (letter === '*' && string[i + 1] === '/') {
          current += '/'
          i += 1
          inComment = false
        }
        continue
      }

      if (escape) {
        escape = false
      } else if (letter === '\\') {
        escape = true
      } else if (inQuote) {
        if (letter === prevQuote) {
          inQuote = false
        }
      } else if (letter === '"' || letter === "'") {
        inQuote = true
        prevQuote = letter
      } else if (letter === '/' && string[i + 1] === '*') {
        current += '/*'
        i += 1
        inComment = true
        continue
      } else if (letter === '(') {
        func += 1
      } else if (letter === ')') {
        if (func > 0) func -= 1
      } else if (func === 0) {
        if (separators.includes(letter)) split = true
      }

      if (split) {
        let value = current.trim()
        if (last || value !== '') array.push(value)
        current = ''
        split = false
      } else {
        current += letter
      }
    }

    let value = current.trim()
    if (last || value !== '') array.push(value)
    return array
  }
}

module.exports = list
list.default = list


/***/ },

/***/ "./node_modules/postcss/lib/map-generator.js"
/*!***************************************************!*\
  !*** ./node_modules/postcss/lib/map-generator.js ***!
  \***************************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";
/* provided dependency */ var Buffer = __webpack_require__(/*! buffer */ "./node_modules/buffer/index.js").Buffer;


let { dirname, relative, resolve, sep } = __webpack_require__(/*! path */ "?25fb")
let { SourceMapConsumer, SourceMapGenerator } = __webpack_require__(/*! source-map-js */ "?6f78")
let { pathToFileURL } = __webpack_require__(/*! url */ "?9214")

let Input = __webpack_require__(/*! ./input */ "./node_modules/postcss/lib/input.js")

let sourceMapAvailable = Boolean(SourceMapConsumer && SourceMapGenerator)
let pathAvailable = Boolean(dirname && resolve && relative && sep)

class MapGenerator {
  constructor(stringify, root, opts, cssString) {
    this.stringify = stringify
    this.mapOpts = opts.map || {}
    this.root = root
    this.opts = opts
    this.css = cssString
    this.originalCSS = cssString
    this.usesFileUrls = !this.mapOpts.from && this.mapOpts.absolute

    this.memoizedFileURLs = new Map()
    this.memoizedPaths = new Map()
    this.memoizedURLs = new Map()
  }

  addAnnotation() {
    let content

    if (this.isInline()) {
      content =
        'data:application/json;base64,' + this.toBase64(this.map.toString())
    } else if (typeof this.mapOpts.annotation === 'string') {
      content = this.mapOpts.annotation
    } else if (typeof this.mapOpts.annotation === 'function') {
      content = this.mapOpts.annotation(this.opts.to, this.root)
    } else {
      content = this.outputFile() + '.map'
    }
    let eol = '\n'
    if (this.css.includes('\r\n')) eol = '\r\n'

    this.css += eol + '/*# sourceMappingURL=' + content + ' */'
  }

  applyPrevMaps() {
    for (let prev of this.previous()) {
      let from = this.toUrl(this.path(prev.file))
      let root = prev.root || dirname(prev.file)
      let map

      if (this.mapOpts.sourcesContent === false) {
        map = new SourceMapConsumer(prev.text)
        if (map.sourcesContent) {
          map.sourcesContent = null
        }
      } else {
        map = prev.consumer()
      }

      this.map.applySourceMap(map, from, this.toUrl(this.path(root)))
    }
  }

  clearAnnotation() {
    if (this.mapOpts.annotation === false) return

    if (this.root) {
      let node
      for (let i = this.root.nodes.length - 1; i >= 0; i--) {
        node = this.root.nodes[i]
        if (node.type !== 'comment') continue
        if (node.text.startsWith('# sourceMappingURL=')) {
          this.root.removeChild(i)
        }
      }
    } else if (this.css) {
      // Single forward pass. Removing every annotation from the whole
      // string separately would be O(n^2) on many annotations.
      let annotation = '/*# sourceMappingURL='
      let css = ''
      let cursor = 0
      let startIndex
      while ((startIndex = this.css.indexOf(annotation, cursor)) !== -1) {
        let endIndex = this.css.indexOf('*/', startIndex + annotation.length)
        if (endIndex === -1) break
        while (startIndex > cursor && this.css[startIndex - 1] === '\n') {
          startIndex--
        }
        css += this.css.slice(cursor, startIndex)
        cursor = endIndex + 2
      }
      if (cursor > 0) this.css = css + this.css.slice(cursor)
    }
  }

  generate() {
    this.clearAnnotation()
    if (pathAvailable && sourceMapAvailable && this.isMap()) {
      return this.generateMap()
    } else {
      let result = ''
      this.stringify(this.root, i => {
        result += i
      })
      return [result]
    }
  }

  generateMap() {
    if (this.root) {
      this.generateString()
    } else if (this.previous().length === 1) {
      let prev = this.previous()[0].consumer()
      prev.file = this.outputFile()
      this.map = SourceMapGenerator.fromSourceMap(prev, {
        ignoreInvalidMapping: true
      })
    } else {
      this.map = new SourceMapGenerator({
        file: this.outputFile(),
        ignoreInvalidMapping: true
      })
      this.map.addMapping({
        generated: { column: 0, line: 1 },
        original: { column: 0, line: 1 },
        source: this.opts.from
          ? this.toUrl(this.path(this.opts.from))
          : '<no source>'
      })
    }

    if (this.isSourcesContent()) this.setSourcesContent()
    if (this.root && this.previous().length > 0) this.applyPrevMaps()
    if (this.isAnnotation()) this.addAnnotation()

    if (this.isInline()) {
      return [this.css]
    } else {
      return [this.css, this.map]
    }
  }

  generateString() {
    this.css = ''
    this.map = new SourceMapGenerator({
      file: this.outputFile(),
      ignoreInvalidMapping: true
    })

    let line = 1
    let column = 1

    let noSource = '<no source>'
    let mapping = {
      generated: { column: 0, line: 0 },
      original: { column: 0, line: 0 },
      source: ''
    }

    let last, lines
    this.stringify(this.root, (str, node, type) => {
      this.css += str

      if (node && type !== 'end') {
        mapping.generated.line = line
        mapping.generated.column = column - 1
        if (node.source && node.source.start) {
          mapping.source = this.sourcePath(node)
          mapping.original.line = node.source.start.line
          mapping.original.column = node.source.start.column - 1
          this.map.addMapping(mapping)
        } else {
          mapping.source = noSource
          mapping.original.line = 1
          mapping.original.column = 0
          this.map.addMapping(mapping)
        }
      }

      lines = str.match(/\n/g)
      if (lines) {
        line += lines.length
        last = str.lastIndexOf('\n')
        column = str.length - last
      } else {
        column += str.length
      }

      if (node && type !== 'start') {
        let p = node.parent || { raws: {} }
        let childless =
          node.type === 'decl' || (node.type === 'atrule' && !node.nodes)
        if (!childless || node !== p.last || p.raws.semicolon) {
          if (node.source && node.source.end) {
            mapping.source = this.sourcePath(node)
            mapping.original.line = node.source.end.line
            mapping.original.column = node.source.end.column - 1
            mapping.generated.line = line
            mapping.generated.column = column - 2
            this.map.addMapping(mapping)
          } else {
            mapping.source = noSource
            mapping.original.line = 1
            mapping.original.column = 0
            mapping.generated.line = line
            mapping.generated.column = column - 1
            this.map.addMapping(mapping)
          }
        }
      }
    })
  }

  isAnnotation() {
    if (this.isInline()) {
      return true
    }
    if (typeof this.mapOpts.annotation !== 'undefined') {
      return this.mapOpts.annotation
    }
    if (this.previous().length) {
      return this.previous().some(i => i.annotation)
    }
    return true
  }

  isInline() {
    if (typeof this.mapOpts.inline !== 'undefined') {
      return this.mapOpts.inline
    }

    let annotation = this.mapOpts.annotation
    if (typeof annotation !== 'undefined' && annotation !== true) {
      return false
    }

    if (this.previous().length) {
      return this.previous().some(i => i.inline)
    }
    return true
  }

  isMap() {
    if (typeof this.opts.map !== 'undefined') {
      return !!this.opts.map
    }
    return this.previous().length > 0
  }

  isSourcesContent() {
    if (typeof this.mapOpts.sourcesContent !== 'undefined') {
      return this.mapOpts.sourcesContent
    }
    if (this.previous().length) {
      return this.previous().some(i => i.withContent())
    }
    return true
  }

  outputFile() {
    if (this.opts.to) {
      return this.path(this.opts.to)
    } else if (this.opts.from) {
      return this.path(this.opts.from)
    } else {
      return 'to.css'
    }
  }

  path(file) {
    if (this.mapOpts.absolute) return file
    if (file.charCodeAt(0) === 60 /* `<` */) return file
    if (/^\w+:\/\//.test(file)) return file
    let cached = this.memoizedPaths.get(file)
    if (cached) return cached

    let from = this.opts.to ? dirname(this.opts.to) : '.'

    if (typeof this.mapOpts.annotation === 'string') {
      from = dirname(resolve(from, this.mapOpts.annotation))
    }

    let path = relative(from, file)
    this.memoizedPaths.set(file, path)

    return path
  }

  previous() {
    if (!this.previousMaps) {
      this.previousMaps = []
      if (this.root) {
        this.root.walk(node => {
          if (node.source && node.source.input.map) {
            let map = node.source.input.map
            if (!this.previousMaps.includes(map)) {
              this.previousMaps.push(map)
            }
          }
        })
      } else {
        let input = new Input(this.originalCSS, this.opts)
        if (input.map) this.previousMaps.push(input.map)
      }
    }

    return this.previousMaps
  }

  setSourcesContent() {
    let already = {}
    if (this.root) {
      this.root.walk(node => {
        if (node.source) {
          let from = node.source.input.from
          if (from && !already[from]) {
            already[from] = true
            let fromUrl = this.usesFileUrls
              ? this.toFileUrl(from)
              : this.toUrl(this.path(from))
            this.map.setSourceContent(fromUrl, node.source.input.css)
          }
        }
      })
    } else if (this.css) {
      let from = this.opts.from
        ? this.toUrl(this.path(this.opts.from))
        : '<no source>'
      this.map.setSourceContent(from, this.css)
    }
  }

  sourcePath(node) {
    if (this.mapOpts.from) {
      return this.toUrl(this.mapOpts.from)
    } else if (this.usesFileUrls) {
      return this.toFileUrl(node.source.input.from)
    } else {
      return this.toUrl(this.path(node.source.input.from))
    }
  }

  toBase64(str) {
    if (Buffer) {
      return Buffer.from(str).toString('base64')
    } else {
      return window.btoa(unescape(encodeURIComponent(str)))
    }
  }

  toFileUrl(path) {
    let cached = this.memoizedFileURLs.get(path)
    if (cached) return cached

    if (pathToFileURL) {
      let fileURL = pathToFileURL(path).toString()
      this.memoizedFileURLs.set(path, fileURL)

      return fileURL
    } else {
      throw new Error(
        '`map.absolute` option is not available in this PostCSS build'
      )
    }
  }

  toUrl(path) {
    let cached = this.memoizedURLs.get(path)
    if (cached) return cached

    if (sep === '\\') {
      path = path.replace(/\\/g, '/')
    }

    let url = encodeURI(path).replace(/[#?]/g, encodeURIComponent)
    this.memoizedURLs.set(path, url)

    return url
  }
}

module.exports = MapGenerator


/***/ },

/***/ "./node_modules/postcss/lib/no-work-result.js"
/*!****************************************************!*\
  !*** ./node_modules/postcss/lib/no-work-result.js ***!
  \****************************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let MapGenerator = __webpack_require__(/*! ./map-generator */ "./node_modules/postcss/lib/map-generator.js")
let parse = __webpack_require__(/*! ./parse */ "./node_modules/postcss/lib/parse.js")
let Result = __webpack_require__(/*! ./result */ "./node_modules/postcss/lib/result.js")
let stringify = __webpack_require__(/*! ./stringify */ "./node_modules/postcss/lib/stringify.js")
let warnOnce = __webpack_require__(/*! ./warn-once */ "./node_modules/postcss/lib/warn-once.js")

class NoWorkResult {
  get content() {
    return this.result.css
  }

  get css() {
    return this.result.css
  }

  get map() {
    return this.result.map
  }

  get messages() {
    return []
  }

  get opts() {
    return this.result.opts
  }

  get processor() {
    return this.result.processor
  }

  get root() {
    if (this._root) {
      return this._root
    }

    let root
    let parser = parse

    try {
      root = parser(this._css, this._opts)
    } catch (error) {
      this.error = error
    }

    if (this.error) {
      throw this.error
    } else {
      this._root = root
      return root
    }
  }

  get [Symbol.toStringTag]() {
    return 'NoWorkResult'
  }

  constructor(processor, css, opts) {
    css = css.toString()
    this.stringified = false

    this._processor = processor
    this._css = css
    this._opts = opts
    this._map = undefined

    let str = stringify
    this.result = new Result(this._processor, undefined, this._opts)
    this.result.css = css

    let self = this
    Object.defineProperty(this.result, 'root', {
      get() {
        return self.root
      }
    })

    let map = new MapGenerator(str, undefined, this._opts, css)
    if (map.isMap()) {
      let [generatedCSS, generatedMap] = map.generate()
      if (generatedCSS) {
        this.result.css = generatedCSS
      }
      if (generatedMap) {
        this.result.map = generatedMap
      }
    } else {
      map.clearAnnotation()
      this.result.css = map.css
    }
  }

  async() {
    if (this.error) return Promise.reject(this.error)
    return Promise.resolve(this.result)
  }

  catch(onRejected) {
    return this.async().catch(onRejected)
  }

  finally(onFinally) {
    return this.async().then(onFinally, onFinally)
  }

  sync() {
    if (this.error) throw this.error
    return this.result
  }

  then(onFulfilled, onRejected) {
    if (true) {
      if (!('from' in this._opts)) {
        warnOnce(
          'Without `from` option PostCSS could generate wrong source map ' +
            'and will not find Browserslist config. Set it to CSS file path ' +
            'or to `undefined` to prevent this warning.'
        )
      }
    }

    return this.async().then(onFulfilled, onRejected)
  }

  toString() {
    return this._css
  }

  warnings() {
    return []
  }
}

module.exports = NoWorkResult
NoWorkResult.default = NoWorkResult


/***/ },

/***/ "./node_modules/postcss/lib/node.js"
/*!******************************************!*\
  !*** ./node_modules/postcss/lib/node.js ***!
  \******************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let CssSyntaxError = __webpack_require__(/*! ./css-syntax-error */ "./node_modules/postcss/lib/css-syntax-error.js")
let Stringifier = __webpack_require__(/*! ./stringifier */ "./node_modules/postcss/lib/stringifier.js")
let stringify = __webpack_require__(/*! ./stringify */ "./node_modules/postcss/lib/stringify.js")
let { isClean, my } = __webpack_require__(/*! ./symbols */ "./node_modules/postcss/lib/symbols.js")

function cloneNode(obj, parent) {
  let cloned = new obj.constructor()
  // An explicit stack instead of recursive calls to survive deeply
  // nested trees. Each entry is [source, its clone, clone's parent].
  let stack = [[obj, cloned, parent]]

  while (stack.length > 0) {
    let [source, target, targetParent] = stack.pop()
    for (let i in source) {
      if (!Object.prototype.hasOwnProperty.call(source, i)) {
        /* c8 ignore next 2 */
        continue
      }
      if (i === 'proxyCache') continue
      let value = source[i]
      let type = typeof value

      if (i === 'parent' && type === 'object') {
        if (targetParent) target[i] = targetParent
      } else if (i === 'source') {
        target[i] = value
      } else if (Array.isArray(value)) {
        let children = []
        target[i] = children
        for (let j of value) {
          let childClone = new j.constructor()
          children.push(childClone)
          stack.push([j, childClone, target])
        }
      } else {
        if (type === 'object' && value !== null) {
          let valueClone = new value.constructor()
          stack.push([value, valueClone, undefined])
          value = valueClone
        }
        target[i] = value
      }
    }
  }

  return cloned
}

function sourceOffset(inputCSS, position) {
  // Not all custom syntaxes support `offset` in `source.start` and `source.end`
  if (position && typeof position.offset !== 'undefined') {
    return position.offset
  }

  let column = 1
  let line = 1
  let offset = 0

  for (let i = 0; i < inputCSS.length; i++) {
    if (line === position.line && column === position.column) {
      offset = i
      break
    }

    if (inputCSS[i] === '\n') {
      column = 1
      line += 1
    } else {
      column += 1
    }
  }

  return offset
}

class Node {
  get proxyOf() {
    return this
  }

  constructor(defaults = {}) {
    this.raws = {}
    this[isClean] = false
    this[my] = true

    for (let name of Object.keys(defaults)) {
      if (name === '__proto__') continue
      if (name === 'nodes') {
        this.nodes = []
        for (let node of defaults[name]) {
          // Clone only nodes that already belong to another tree, so passing a
          // freshly created (parent-less) node adopts that instance instead of
          // a copy and keeps the caller's reference usable. See #1987.
          if (typeof node.clone === 'function' && node.parent) {
            this.append(node.clone())
          } else {
            this.append(node)
          }
        }
      } else {
        this[name] = defaults[name]
      }
    }
  }

  addToError(error) {
    error.postcssNode = this
    if (error.stack && this.source && /\n\s{4}at /.test(error.stack)) {
      let s = this.source
      error.stack = error.stack.replace(
        /\n\s{4}at /,
        `$&${s.input.from}:${s.start.line}:${s.start.column}$&`
      )
    }
    return error
  }

  after(add) {
    this.parent.insertAfter(this, add)
    return this
  }

  assign(overrides = {}) {
    for (let name in overrides) {
      this[name] = overrides[name]
    }
    return this
  }

  before(add) {
    this.parent.insertBefore(this, add)
    return this
  }

  cleanRaws(keepBetween) {
    delete this.raws.before
    delete this.raws.after
    if (!keepBetween) delete this.raws.between
  }

  clone(overrides = {}) {
    let cloned = cloneNode(this)
    for (let name in overrides) {
      cloned[name] = overrides[name]
    }
    return cloned
  }

  cloneAfter(overrides = {}) {
    let cloned = this.clone(overrides)
    this.parent.insertAfter(this, cloned)
    return cloned
  }

  cloneBefore(overrides = {}) {
    let cloned = this.clone(overrides)
    this.parent.insertBefore(this, cloned)
    return cloned
  }

  error(message, opts = {}) {
    if (this.source) {
      let { end, start } = this.rangeBy(opts)
      return this.source.input.error(
        message,
        { column: start.column, line: start.line },
        { column: end.column, line: end.line },
        opts
      )
    }
    return new CssSyntaxError(message)
  }

  getProxyProcessor() {
    return {
      get(node, prop) {
        if (prop === 'proxyOf') {
          return node
        } else if (prop === 'root') {
          return () => node.root().toProxy()
        } else {
          return node[prop]
        }
      },

      set(node, prop, value) {
        if (node[prop] === value) return true
        node[prop] = value
        if (
          prop === 'prop' ||
          prop === 'value' ||
          prop === 'name' ||
          prop === 'params' ||
          prop === 'important' ||
          /* c8 ignore next */
          prop === 'text'
        ) {
          node.markDirty()
        }
        return true
      }
    }
  }

  /* c8 ignore next 3 */
  markClean() {
    this[isClean] = true
  }

  markDirty() {
    if (this[isClean]) {
      this[isClean] = false
      let next = this
      while ((next = next.parent)) {
        next[isClean] = false
      }
    }
  }

  next() {
    if (!this.parent) return undefined
    let index = this.parent.index(this)
    return this.parent.nodes[index + 1]
  }

  positionBy(opts = {}) {
    let inputString =
      'document' in this.source.input
        ? this.source.input.document
        : this.source.input.css
    let pos = {
      column: this.source.start.column,
      line: this.source.start.line,
      offset: sourceOffset(inputString, this.source.start)
    }
    if (opts.index) {
      pos = this.positionInside(opts.index)
    } else if (opts.word) {
      let stringRepresentation = inputString.slice(
        sourceOffset(inputString, this.source.start),
        sourceOffset(inputString, this.source.end)
      )
      let index = stringRepresentation.indexOf(opts.word)
      if (index !== -1) pos = this.positionInside(index)
    }
    return pos
  }

  positionInside(index) {
    let column = this.source.start.column
    let line = this.source.start.line
    let inputString =
      'document' in this.source.input
        ? this.source.input.document
        : this.source.input.css
    let offset = sourceOffset(inputString, this.source.start)
    let end = offset + index

    for (let i = offset; i < end; i++) {
      if (inputString[i] === '\n') {
        column = 1
        line += 1
      } else {
        column += 1
      }
    }

    return { column, line, offset: end }
  }

  prev() {
    if (!this.parent) return undefined
    let index = this.parent.index(this)
    return this.parent.nodes[index - 1]
  }

  rangeBy(opts = {}) {
    let inputString =
      'document' in this.source.input
        ? this.source.input.document
        : this.source.input.css
    let start = {
      column: this.source.start.column,
      line: this.source.start.line,
      offset: sourceOffset(inputString, this.source.start)
    }
    let end = this.source.end
      ? {
          column: this.source.end.column + 1,
          line: this.source.end.line,
          offset:
            typeof this.source.end.offset === 'number'
              ? // `source.end.offset` is exclusive, so we don't need to add 1
                this.source.end.offset
              : // Since line/column in this.source.end is inclusive,
                // the `sourceOffset(... , this.source.end)` returns an inclusive offset.
                // So, we add 1 to convert it to exclusive.
                sourceOffset(inputString, this.source.end) + 1
        }
      : {
          column: start.column + 1,
          line: start.line,
          offset: start.offset + 1
        }

    if (opts.word) {
      let stringRepresentation = inputString.slice(
        sourceOffset(inputString, this.source.start),
        sourceOffset(inputString, this.source.end)
      )
      let index = stringRepresentation.indexOf(opts.word)
      if (index !== -1) {
        start = this.positionInside(index)
        end = this.positionInside(index + opts.word.length)
      }
    } else {
      if (opts.start) {
        start = {
          column: opts.start.column,
          line: opts.start.line,
          offset: sourceOffset(inputString, opts.start)
        }
      } else if (typeof opts.index === 'number') {
        start = this.positionInside(opts.index)
      }

      if (opts.end) {
        end = {
          column: opts.end.column,
          line: opts.end.line,
          offset: sourceOffset(inputString, opts.end)
        }
      } else if (typeof opts.endIndex === 'number') {
        end = this.positionInside(opts.endIndex)
      } else if (typeof opts.index === 'number') {
        end = this.positionInside(opts.index + 1)
      }
    }

    if (
      end.line < start.line ||
      (end.line === start.line && end.column <= start.column)
    ) {
      end = {
        column: start.column + 1,
        line: start.line,
        offset: start.offset + 1
      }
    }

    return { end, start }
  }

  raw(prop, defaultType) {
    let str = new Stringifier()
    return str.raw(this, prop, defaultType)
  }

  remove() {
    if (this.parent) {
      this.parent.removeChild(this)
    }
    this.parent = undefined
    return this
  }

  replaceWith(...nodes) {
    if (this.parent) {
      let bookmark = this
      let foundSelf = false
      for (let node of nodes) {
        if (node === this) {
          foundSelf = true
        } else if (foundSelf) {
          this.parent.insertAfter(bookmark, node)
          bookmark = node
        } else {
          this.parent.insertBefore(bookmark, node)
        }
      }

      if (!foundSelf) {
        this.remove()
      }
    }

    return this
  }

  root() {
    let result = this
    while (result.parent && result.parent.type !== 'document') {
      result = result.parent
    }
    return result
  }

  toJSON(_, inputs) {
    let emitInputs = inputs == null
    inputs = inputs || new Map()

    // A worklist instead of recursive `toJSON()` calls to survive deeply
    // nested trees. Each entry converts one node and writes the result
    // into the already converted parent by [holder, key].
    let holderOfRoot = []
    let queue = [[this, holderOfRoot, 0]]

    for (let step = 0; step < queue.length; step++) {
      let [node, holder, key] = queue[step]
      let fixed = {}
      holder[key] = fixed

      for (let name in node) {
        if (!Object.prototype.hasOwnProperty.call(node, name)) {
          /* c8 ignore next 2 */
          continue
        }
        if (name === 'parent' || name === 'proxyCache') continue
        let value = node[name]

        if (Array.isArray(value)) {
          let fixedArray = []
          fixed[name] = fixedArray
          for (let i = 0; i < value.length; i++) {
            let item = value[i]
            if (typeof item === 'object' && item.toJSON) {
              if (item.toJSON === Node.prototype.toJSON) {
                queue.push([item, fixedArray, i])
              } else {
                fixedArray[i] = item.toJSON(null, inputs)
              }
            } else {
              fixedArray[i] = item
            }
          }
        } else if (typeof value === 'object' && value.toJSON) {
          if (value.toJSON === Node.prototype.toJSON) {
            queue.push([value, fixed, name])
          } else {
            fixed[name] = value.toJSON(null, inputs)
          }
        } else if (name === 'source') {
          if (value == null) continue
          let inputId = inputs.get(value.input)
          if (inputId == null) {
            inputId = inputs.size
            inputs.set(value.input, inputId)
          }
          fixed[name] = {
            end: value.end,
            inputId,
            start: value.start
          }
        } else {
          fixed[name] = value
        }
      }
    }

    let fixed = holderOfRoot[0]
    if (emitInputs) {
      fixed.inputs = [...inputs.keys()].map(input => input.toJSON())
    }

    return fixed
  }

  toProxy() {
    if (!this.proxyCache) {
      this.proxyCache = new Proxy(this, this.getProxyProcessor())
    }
    return this.proxyCache
  }

  toString(stringifier = stringify) {
    if (stringifier.stringify) stringifier = stringifier.stringify
    let result = ''
    stringifier(this, i => {
      result += i
    })
    return result
  }

  warn(result, text, opts = {}) {
    let data = { node: this }
    for (let i in opts) data[i] = opts[i]
    return result.warn(text, data)
  }
}

module.exports = Node
Node.default = Node


/***/ },

/***/ "./node_modules/postcss/lib/parse.js"
/*!*******************************************!*\
  !*** ./node_modules/postcss/lib/parse.js ***!
  \*******************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Container = __webpack_require__(/*! ./container */ "./node_modules/postcss/lib/container.js")
let Input = __webpack_require__(/*! ./input */ "./node_modules/postcss/lib/input.js")
let Parser = __webpack_require__(/*! ./parser */ "./node_modules/postcss/lib/parser.js")

function parse(css, opts) {
  let input = new Input(css, opts)
  let parser = new Parser(input)
  try {
    parser.parse()
  } catch (e) {
    if (true) {
      if (e.name === 'CssSyntaxError' && opts && opts.from) {
        if (/\.scss$/i.test(opts.from)) {
          e.message +=
            '\nYou tried to parse SCSS with ' +
            'the standard CSS parser; ' +
            'try again with the postcss-scss parser'
        } else if (/\.sass/i.test(opts.from)) {
          e.message +=
            '\nYou tried to parse Sass with ' +
            'the standard CSS parser; ' +
            'try again with the postcss-sass parser'
        } else if (/\.less$/i.test(opts.from)) {
          e.message +=
            '\nYou tried to parse Less with ' +
            'the standard CSS parser; ' +
            'try again with the postcss-less parser'
        }
      }
    }
    throw e
  }

  return parser.root
}

module.exports = parse
parse.default = parse

Container.registerParse(parse)


/***/ },

/***/ "./node_modules/postcss/lib/parser.js"
/*!********************************************!*\
  !*** ./node_modules/postcss/lib/parser.js ***!
  \********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let AtRule = __webpack_require__(/*! ./at-rule */ "./node_modules/postcss/lib/at-rule.js")
let Comment = __webpack_require__(/*! ./comment */ "./node_modules/postcss/lib/comment.js")
let Declaration = __webpack_require__(/*! ./declaration */ "./node_modules/postcss/lib/declaration.js")
let Root = __webpack_require__(/*! ./root */ "./node_modules/postcss/lib/root.js")
let Rule = __webpack_require__(/*! ./rule */ "./node_modules/postcss/lib/rule.js")
let tokenizer = __webpack_require__(/*! ./tokenize */ "./node_modules/postcss/lib/tokenize.js")

const SAFE_COMMENT_NEIGHBOR = {
  empty: true,
  space: true
}

function findLastWithPosition(tokens) {
  for (let i = tokens.length - 1; i >= 0; i--) {
    let token = tokens[i]
    let pos = token[3] || token[2]
    if (pos) return pos
  }
}

function tokensToString(tokens, from, to) {
  let result = ''
  for (let i = from; i < to; i++) result += tokens[i][1]
  return result
}

class Parser {
  constructor(input) {
    this.input = input

    this.root = new Root()
    this.current = this.root
    this.spaces = ''
    this.semicolon = false

    this.createTokenizer()
    this.root.source = { input, start: { column: 1, line: 1, offset: 0 } }
  }

  atrule(token) {
    let node = new AtRule()
    node.name = token[1].slice(1)
    if (node.name === '') {
      this.unnamedAtrule(node, token)
    }
    this.init(node, token[2])

    let type
    let prev
    let shift
    let last = false
    let open = false
    let params = []
    let brackets = []

    while (!this.tokenizer.endOfFile()) {
      token = this.tokenizer.nextToken()
      type = token[0]

      if (type === '(' || type === '[') {
        brackets.push(type === '(' ? ')' : ']')
      } else if (type === '{' && brackets.length > 0) {
        brackets.push('}')
      } else if (type === brackets[brackets.length - 1]) {
        brackets.pop()
      }

      if (brackets.length === 0) {
        if (type === ';') {
          node.source.end = this.getPosition(token[2])
          node.source.end.offset++
          this.semicolon = true
          break
        } else if (type === '{') {
          open = true
          break
        } else if (type === '}') {
          if (params.length > 0) {
            shift = params.length - 1
            prev = params[shift]
            while (prev && prev[0] === 'space') {
              prev = params[--shift]
            }
            if (prev) {
              node.source.end = this.getPosition(prev[3] || prev[2])
              node.source.end.offset++
            }
          }
          this.end(token)
          break
        } else {
          params.push(token)
        }
      } else {
        params.push(token)
      }

      if (this.tokenizer.endOfFile()) {
        last = true
        break
      }
    }

    node.raws.between = this.spacesAndCommentsFromEnd(params)
    if (params.length) {
      node.raws.afterName = this.spacesAndCommentsFromStart(params)
      this.raw(node, 'params', params)
      if (last) {
        token = params[params.length - 1]
        node.source.end = this.getPosition(token[3] || token[2])
        node.source.end.offset++
        this.spaces = node.raws.between
        node.raws.between = ''
      }
    } else {
      node.raws.afterName = ''
      node.params = ''
    }

    if (open) {
      node.nodes = []
      this.current = node
    }
  }

  checkMissedSemicolon(tokens) {
    let colon = this.colon(tokens)
    if (colon === false) return

    let founded = 0
    let token
    for (let j = colon - 1; j >= 0; j--) {
      token = tokens[j]
      if (token[0] !== 'space') {
        founded += 1
        if (founded === 2) break
      }
    }
    // If the token is a word, e.g. `!important`, `red` or any other valid
    // property's value. Then we need to return the colon after that word
    // token. [3] is the "end" colon of that word. And because we need it
    // after that one we do +1 to get the next one.
    throw this.input.error(
      'Missed semicolon',
      token[0] === 'word' ? token[3] + 1 : token[2]
    )
  }

  colon(tokens) {
    let brackets = 0
    let prev, token, type
    for (let [i, element] of tokens.entries()) {
      token = element
      type = token[0]

      if (type === '(') {
        brackets += 1
      }
      if (type === ')') {
        brackets -= 1
      }
      if (brackets === 0 && type === ':') {
        if (!prev) {
          this.doubleColon(token)
        } else if (prev[0] === 'word' && prev[1] === 'progid') {
          continue
        } else {
          return i
        }
      }

      prev = token
    }
    return false
  }

  comment(token) {
    let node = new Comment()
    this.init(node, token[2])
    node.source.end = this.getPosition(token[3] || token[2])
    node.source.end.offset++

    let text = token[1].slice(2, -2)
    if (!text.trim()) {
      node.text = ''
      node.raws.left = text
      node.raws.right = ''
    } else {
      let match = text.match(/^(\s*)([^]*\S)(\s*)$/)
      node.text = match[2]
      node.raws.left = match[1]
      node.raws.right = match[3]
    }
  }

  createTokenizer() {
    this.tokenizer = tokenizer(this.input)
  }

  decl(tokens, customProperty) {
    let node = new Declaration()
    this.init(node, tokens[0][2])

    let last = tokens[tokens.length - 1]
    if (last[0] === ';') {
      this.semicolon = true
      tokens.pop()
    }

    node.source.end = this.getPosition(
      last[3] || last[2] || findLastWithPosition(tokens)
    )
    node.source.end.offset++

    let start = 0
    while (tokens[start][0] !== 'word') {
      if (start === tokens.length - 1) this.unknownWord([tokens[start]])
      start++
    }
    node.raws.before += tokensToString(tokens, 0, start)
    node.source.start = this.getPosition(tokens[start][2])

    let propStart = start
    while (start < tokens.length) {
      let type = tokens[start][0]
      if (type === ':' || type === 'space' || type === 'comment') {
        break
      }
      start++
    }
    node.prop = tokensToString(tokens, propStart, start)

    let betweenStart = start
    let token
    while (start < tokens.length) {
      token = tokens[start]
      start++
      if (token[0] === ':') break
      if (token[0] === 'word' && /\w/.test(token[1])) {
        this.unknownWord([token])
      }
    }
    node.raws.between = tokensToString(tokens, betweenStart, start)

    if (node.prop[0] === '_' || node.prop[0] === '*') {
      node.raws.before += node.prop[0]
      node.prop = node.prop.slice(1)
    }

    let firstSpacesStart = start
    while (start < tokens.length) {
      let next = tokens[start][0]
      if (next !== 'space' && next !== 'comment') break
      start++
    }
    let firstSpaces = tokens.slice(firstSpacesStart, start)

    tokens = tokens.slice(start)

    this.precheckMissedSemicolon(tokens)

    for (let i = tokens.length - 1; i >= 0; i--) {
      token = tokens[i]
      if (token[1].toLowerCase() === '!important') {
        node.important = true
        let string = this.stringFrom(tokens, i)
        string = this.spacesFromEnd(tokens) + string
        if (string !== ' !important') node.raws.important = string
        break
      } else if (token[1].toLowerCase() === 'important') {
        let cache = tokens.slice(0)
        let str = ''
        for (let j = i; j > 0; j--) {
          let type = cache[j][0]
          if (str.trim().startsWith('!') && type !== 'space') {
            break
          }
          str = cache.pop()[1] + str
        }
        if (str.trim().startsWith('!')) {
          node.important = true
          node.raws.important = str
          tokens = cache
        }
      }

      if (token[0] !== 'space' && token[0] !== 'comment') {
        break
      }
    }

    let hasWord = tokens.some(i => i[0] !== 'space' && i[0] !== 'comment')

    if (hasWord) {
      node.raws.between += firstSpaces.map(i => i[1]).join('')
      firstSpaces = []
    }
    this.raw(node, 'value', firstSpaces.concat(tokens), customProperty)

    if (node.value.includes(':') && !customProperty) {
      this.checkMissedSemicolon(tokens)
    }
  }

  doubleColon(token) {
    throw this.input.error(
      'Double colon',
      { offset: token[2] },
      { offset: token[2] + token[1].length }
    )
  }

  emptyRule(token) {
    let node = new Rule()
    this.init(node, token[2])
    node.selector = ''
    node.raws.between = ''
    this.current = node
  }

  end(token) {
    if (this.current.nodes && this.current.nodes.length) {
      this.current.raws.semicolon = this.semicolon
    }
    this.semicolon = false

    this.current.raws.after = (this.current.raws.after || '') + this.spaces
    this.spaces = ''

    if (this.current.parent) {
      this.current.source.end = this.getPosition(token[2])
      this.current.source.end.offset++
      this.current = this.current.parent
    } else {
      this.unexpectedClose(token)
    }
  }

  endFile() {
    if (this.current.parent) this.unclosedBlock()
    if (this.current.nodes && this.current.nodes.length) {
      this.current.raws.semicolon = this.semicolon
    }
    this.current.raws.after = (this.current.raws.after || '') + this.spaces
    this.root.source.end = this.getPosition(this.tokenizer.position())
  }

  freeSemicolon(token) {
    this.spaces += token[1]
    if (this.current.nodes) {
      let prev = this.current.nodes[this.current.nodes.length - 1]
      if (prev && prev.type === 'rule' && !prev.raws.ownSemicolon) {
        prev.raws.ownSemicolon = this.spaces
        this.spaces = ''
        // `ownSemicolon` also holds the spaces before the semicolon, but
        // the position above is the semicolon itself, so the node ends
        // right after it.
        prev.source.end = this.getPosition(token[2])
        prev.source.end.offset++
      }
    }
  }

  // Helpers

  getPosition(offset) {
    let pos = this.input.fromOffset(offset)
    return {
      column: pos.col,
      line: pos.line,
      offset
    }
  }

  init(node, offset) {
    this.current.push(node)
    node.source = {
      input: this.input,
      start: this.getPosition(offset)
    }
    node.raws.before = this.spaces
    this.spaces = ''
    if (node.type !== 'comment') this.semicolon = false
  }

  other(start) {
    let end = false
    let type = null
    let colon = false
    let bracket = null
    let brackets = []
    let customProperty = start[1].startsWith('--')

    let tokens = []
    let token = start
    while (token) {
      type = token[0]
      tokens.push(token)

      if (type === '(' || type === '[') {
        if (!bracket) bracket = token
        brackets.push(type === '(' ? ')' : ']')
      } else if (customProperty && colon && type === '{') {
        if (!bracket) bracket = token
        brackets.push('}')
      } else if (brackets.length === 0) {
        if (type === ';') {
          if (colon) {
            this.decl(tokens, customProperty)
            return
          } else {
            break
          }
        } else if (type === '{') {
          this.rule(tokens)
          return
        } else if (type === '}') {
          this.tokenizer.back(tokens.pop())
          end = true
          break
        } else if (type === ':') {
          colon = true
        }
      } else if (type === brackets[brackets.length - 1]) {
        brackets.pop()
        if (brackets.length === 0) bracket = null
      }

      token = this.tokenizer.nextToken()
    }

    if (this.tokenizer.endOfFile()) end = true
    if (brackets.length > 0) this.unclosedBracket(bracket)

    if (end && colon) {
      if (!customProperty) {
        while (tokens.length) {
          token = tokens[tokens.length - 1][0]
          if (token !== 'space' && token !== 'comment') break
          this.tokenizer.back(tokens.pop())
        }
      }
      this.decl(tokens, customProperty)
    } else {
      this.unknownWord(tokens)
    }
  }

  parse() {
    let token
    while (!this.tokenizer.endOfFile()) {
      token = this.tokenizer.nextToken()

      switch (token[0]) {
        case 'space':
          this.spaces += token[1]
          break

        case ';':
          this.freeSemicolon(token)
          break

        case '}':
          this.end(token)
          break

        case 'comment':
          this.comment(token)
          break

        case 'at-word':
          this.atrule(token)
          break

        case '{':
          this.emptyRule(token)
          break

        default:
          this.other(token)
          break
      }
    }
    this.endFile()
  }

  precheckMissedSemicolon(/* tokens */) {
    // Hook for Safe Parser
  }

  raw(node, prop, tokens, customProperty) {
    let token, type
    let length = tokens.length
    let value = ''
    // Last character of `value`. Reading it from `value` would flatten
    // the string concatenation on every comment and make parsing O(n^2).
    let last = ''
    let clean = true
    let next, prev

    for (let i = 0; i < length; i += 1) {
      token = tokens[i]
      type = token[0]
      if (type === 'space' && i === length - 1 && !customProperty) {
        clean = false
      } else if (type === 'comment') {
        prev = tokens[i - 1] ? tokens[i - 1][0] : 'empty'
        next = tokens[i + 1] ? tokens[i + 1][0] : 'empty'
        if (!SAFE_COMMENT_NEIGHBOR[prev] && !SAFE_COMMENT_NEIGHBOR[next]) {
          if (last === ',') {
            clean = false
          } else {
            value += token[1]
            last = token[1].slice(-1)
          }
        } else {
          clean = false
        }
      } else {
        value += token[1]
        last = token[1].slice(-1)
      }
    }
    if (!clean) {
      let raw = tokens.reduce((all, i) => all + i[1], '')
      node.raws[prop] = { raw, value }
    }
    node[prop] = value
  }

  rule(tokens) {
    tokens.pop()

    let node = new Rule()
    this.init(node, tokens[0][2])

    node.raws.between = this.spacesAndCommentsFromEnd(tokens)
    this.raw(node, 'selector', tokens)
    this.current = node
  }

  spacesAndCommentsFromEnd(tokens) {
    let lastTokenType
    let spaces = ''
    while (tokens.length) {
      lastTokenType = tokens[tokens.length - 1][0]
      if (lastTokenType !== 'space' && lastTokenType !== 'comment') break
      spaces = tokens.pop()[1] + spaces
    }
    return spaces
  }

  // Errors

  spacesAndCommentsFromStart(tokens) {
    let next
    let spaces = ''
    while (tokens.length) {
      next = tokens[0][0]
      if (next !== 'space' && next !== 'comment') break
      spaces += tokens.shift()[1]
    }
    return spaces
  }

  spacesFromEnd(tokens) {
    let lastTokenType
    let spaces = ''
    while (tokens.length) {
      lastTokenType = tokens[tokens.length - 1][0]
      if (lastTokenType !== 'space') break
      spaces = tokens.pop()[1] + spaces
    }
    return spaces
  }

  stringFrom(tokens, from) {
    let result = ''
    for (let i = from; i < tokens.length; i++) {
      result += tokens[i][1]
    }
    tokens.splice(from, tokens.length - from)
    return result
  }

  unclosedBlock() {
    let pos = this.current.source.start
    throw this.input.error('Unclosed block', pos.line, pos.column)
  }

  unclosedBracket(bracket) {
    throw this.input.error(
      'Unclosed bracket',
      { offset: bracket[2] },
      { offset: bracket[2] + 1 }
    )
  }

  unexpectedClose(token) {
    throw this.input.error(
      'Unexpected }',
      { offset: token[2] },
      { offset: token[2] + 1 }
    )
  }

  unknownWord(tokens) {
    throw this.input.error(
      'Unknown word ' + tokens[0][1],
      { offset: tokens[0][2] },
      { offset: tokens[0][2] + tokens[0][1].length }
    )
  }

  unnamedAtrule(node, token) {
    throw this.input.error(
      'At-rule without name',
      { offset: token[2] },
      { offset: token[2] + token[1].length }
    )
  }
}

module.exports = Parser


/***/ },

/***/ "./node_modules/postcss/lib/postcss.js"
/*!*********************************************!*\
  !*** ./node_modules/postcss/lib/postcss.js ***!
  \*********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";
/* provided dependency */ var process = __webpack_require__(/*! process/browser.js */ "./node_modules/process/browser.js");


let AtRule = __webpack_require__(/*! ./at-rule */ "./node_modules/postcss/lib/at-rule.js")
let Comment = __webpack_require__(/*! ./comment */ "./node_modules/postcss/lib/comment.js")
let Container = __webpack_require__(/*! ./container */ "./node_modules/postcss/lib/container.js")
let CssSyntaxError = __webpack_require__(/*! ./css-syntax-error */ "./node_modules/postcss/lib/css-syntax-error.js")
let Declaration = __webpack_require__(/*! ./declaration */ "./node_modules/postcss/lib/declaration.js")
let Document = __webpack_require__(/*! ./document */ "./node_modules/postcss/lib/document.js")
let fromJSON = __webpack_require__(/*! ./fromJSON */ "./node_modules/postcss/lib/fromJSON.js")
let Input = __webpack_require__(/*! ./input */ "./node_modules/postcss/lib/input.js")
let LazyResult = __webpack_require__(/*! ./lazy-result */ "./node_modules/postcss/lib/lazy-result.js")
let list = __webpack_require__(/*! ./list */ "./node_modules/postcss/lib/list.js")
let Node = __webpack_require__(/*! ./node */ "./node_modules/postcss/lib/node.js")
let parse = __webpack_require__(/*! ./parse */ "./node_modules/postcss/lib/parse.js")
let Processor = __webpack_require__(/*! ./processor */ "./node_modules/postcss/lib/processor.js")
let Result = __webpack_require__(/*! ./result.js */ "./node_modules/postcss/lib/result.js")
let Root = __webpack_require__(/*! ./root */ "./node_modules/postcss/lib/root.js")
let Rule = __webpack_require__(/*! ./rule */ "./node_modules/postcss/lib/rule.js")
let stringify = __webpack_require__(/*! ./stringify */ "./node_modules/postcss/lib/stringify.js")
let Warning = __webpack_require__(/*! ./warning */ "./node_modules/postcss/lib/warning.js")

function postcss(...plugins) {
  if (plugins.length === 1 && Array.isArray(plugins[0])) {
    plugins = plugins[0]
  }
  return new Processor(plugins)
}

postcss.plugin = function plugin(name, initializer) {
  let warningPrinted = false
  function creator(...args) {
    // eslint-disable-next-line no-console
    if (console && console.warn && !warningPrinted) {
      warningPrinted = true
      // eslint-disable-next-line no-console
      console.warn(
        name +
          ': postcss.plugin was deprecated. Migration guide:\n' +
          'https://evilmartians.com/chronicles/postcss-8-plugin-migration'
      )
      if (process.env.LANG && process.env.LANG.startsWith('zh')) {
        /* c8 ignore next 7 */
        // eslint-disable-next-line no-console
        console.warn(
          name +
            ': 里面 postcss.plugin 被弃用. 迁移指南:\n' +
            'https://www.w3ctech.com/topic/2226'
        )
      }
    }
    let transformer = initializer(...args)
    transformer.postcssPlugin = name
    transformer.postcssVersion = new Processor().version
    return transformer
  }

  let cache
  Object.defineProperty(creator, 'postcss', {
    get() {
      if (!cache) cache = creator()
      return cache
    }
  })

  creator.process = function (css, processOpts, pluginOpts) {
    return postcss([creator(pluginOpts)]).process(css, processOpts)
  }

  return creator
}

postcss.stringify = stringify
postcss.parse = parse
postcss.fromJSON = fromJSON
postcss.list = list

postcss.comment = defaults => new Comment(defaults)
postcss.atRule = defaults => new AtRule(defaults)
postcss.decl = defaults => new Declaration(defaults)
postcss.rule = defaults => new Rule(defaults)
postcss.root = defaults => new Root(defaults)
postcss.document = defaults => new Document(defaults)

postcss.CssSyntaxError = CssSyntaxError
postcss.Declaration = Declaration
postcss.Container = Container
postcss.Processor = Processor
postcss.Document = Document
postcss.Comment = Comment
postcss.Warning = Warning
postcss.AtRule = AtRule
postcss.Result = Result
postcss.Input = Input
postcss.Rule = Rule
postcss.Root = Root
postcss.Node = Node

LazyResult.registerPostcss(postcss)

module.exports = postcss
postcss.default = postcss


/***/ },

/***/ "./node_modules/postcss/lib/previous-map.js"
/*!**************************************************!*\
  !*** ./node_modules/postcss/lib/previous-map.js ***!
  \**************************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";
/* provided dependency */ var Buffer = __webpack_require__(/*! buffer */ "./node_modules/buffer/index.js").Buffer;


let { existsSync, readFileSync, realpathSync } = __webpack_require__(/*! fs */ "?2f81")
let { dirname, isAbsolute, join, relative, sep } = __webpack_require__(/*! path */ "?25fb")
let { SourceMapConsumer, SourceMapGenerator } = __webpack_require__(/*! source-map-js */ "?6f78")

function realPath(path) {
  try {
    return realpathSync(path)
  } catch {
    // Missing or dangling: keep the literal path. The existsSync() check below
    // still gates the read, and a path that does not exist cannot escape.
    return path
  }
}

function fromBase64(str) {
  if (Buffer) {
    return Buffer.from(str, 'base64').toString()
  } else {
    /* c8 ignore next 2 */
    return window.atob(str)
  }
}

class PreviousMap {
  constructor(css, opts) {
    if (opts.map === false) return
    if (opts.unsafeMap) this.unsafeMap = true
    this.loadAnnotation(css)
    this.inline = this.startWith(this.annotation, 'data:')

    let prev = opts.map ? opts.map.prev : undefined
    let text = this.loadMap(opts.from, prev)
    if (!this.mapFile && opts.from) {
      this.mapFile = opts.from
    }
    if (this.mapFile) this.root = dirname(this.mapFile)
    if (text) this.text = text
  }

  consumer() {
    if (!this.consumerCache) {
      this.consumerCache = new SourceMapConsumer(this.json || this.text)
    }
    return this.consumerCache
  }

  decodeInline(text) {
    let baseCharsetUri = /^data:application\/json;charset=utf-?8;base64,/
    let baseUri = /^data:application\/json;base64,/
    let charsetUri = /^data:application\/json;charset=utf-?8,/
    let uri = /^data:application\/json,/

    let uriMatch = text.match(charsetUri) || text.match(uri)
    if (uriMatch) {
      return decodeURIComponent(text.substr(uriMatch[0].length))
    }

    let baseUriMatch = text.match(baseCharsetUri) || text.match(baseUri)
    if (baseUriMatch) {
      return fromBase64(text.substr(baseUriMatch[0].length))
    }

    let encoding = text.slice('data:application/json;'.length)
    encoding = encoding.slice(0, encoding.indexOf(','))
    throw new Error('Unsupported source map encoding ' + encoding)
  }

  getAnnotationURL(sourceMapString) {
    return sourceMapString.replace(/^\/\*\s*# sourceMappingURL=/, '').trim()
  }

  isMap(map) {
    if (typeof map !== 'object') return false
    return (
      typeof map.mappings === 'string' ||
      typeof map._mappings === 'string' ||
      Array.isArray(map.sections)
    )
  }

  loadAnnotation(css) {
    let comments = css.match(/\/\*\s*# sourceMappingURL=/g)
    if (!comments) return

    // sourceMappingURLs from comments, strings, etc.
    let start = css.lastIndexOf(comments.pop())
    let end = css.indexOf('*/', start)

    if (start > -1 && end > -1) {
      // Locate the last sourceMappingURL to avoid pickin
      this.annotation = this.getAnnotationURL(css.substring(start, end))
    }
  }

  loadFile(path, cssFile, trusted) {
    if (!trusted && !this.unsafeMap) {
      if (!/\.map$/i.test(path)) return undefined
      if (!cssFile) return undefined

      // Compare *resolved* paths: relative() is textual, so without this a
      // symlink at or below the CSS file's directory points the map outside it.
      let rel = relative(realPath(dirname(cssFile)), realPath(path))
      if (rel === '..' || rel.startsWith('..' + sep) || isAbsolute(rel)) {
        return undefined
      }
    }
    this.root = dirname(path)
    if (existsSync(path)) {
      this.mapFile = path
      return readFileSync(path, 'utf-8').toString().trim()
    }
  }

  loadMap(file, prev) {
    if (prev === false) return false

    if (prev) {
      if (typeof prev === 'string') {
        return prev
      } else if (typeof prev === 'function') {
        let prevPath = prev(file)
        if (prevPath) {
          let map = this.loadFile(prevPath, file, true)
          if (!map) {
            throw new Error(
              'Unable to load previous source map: ' + prevPath.toString()
            )
          }
          return map
        }
      } else if (prev instanceof SourceMapConsumer) {
        return SourceMapGenerator.fromSourceMap(prev).toString()
      } else if (prev instanceof SourceMapGenerator) {
        return prev.toString()
      } else if (this.isMap(prev)) {
        return JSON.stringify(prev)
      } else {
        throw new Error(
          'Unsupported previous source map format: ' + prev.toString()
        )
      }
    } else if (this.inline) {
      return this.decodeInline(this.annotation)
    } else if (this.annotation) {
      let map = this.annotation
      if (file) map = join(dirname(file), map)
      let unknown = this.loadFile(map, file, false)
      if (unknown) {
        try {
          /* c8 ignore next 4 */
          this.json = JSON.parse(unknown.replace(/^\)]}'[^\n]*\n/, ''))
        } catch {
          return undefined
        }
      }
      return unknown
    }
  }

  startWith(string, start) {
    if (!string) return false
    return string.substr(0, start.length) === start
  }

  withContent() {
    return !!(
      this.consumer().sourcesContent &&
      this.consumer().sourcesContent.length > 0
    )
  }
}

module.exports = PreviousMap
PreviousMap.default = PreviousMap


/***/ },

/***/ "./node_modules/postcss/lib/processor.js"
/*!***********************************************!*\
  !*** ./node_modules/postcss/lib/processor.js ***!
  \***********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Document = __webpack_require__(/*! ./document */ "./node_modules/postcss/lib/document.js")
let LazyResult = __webpack_require__(/*! ./lazy-result */ "./node_modules/postcss/lib/lazy-result.js")
let NoWorkResult = __webpack_require__(/*! ./no-work-result */ "./node_modules/postcss/lib/no-work-result.js")
let Root = __webpack_require__(/*! ./root */ "./node_modules/postcss/lib/root.js")

class Processor {
  constructor(plugins = []) {
    this.version = '8.5.29'
    this.plugins = this.normalize(plugins)
  }

  normalize(plugins) {
    let normalized = []
    for (let i of plugins) {
      if (i.postcss === true) {
        i = i()
      } else if (i.postcss) {
        i = i.postcss
      }

      if (typeof i === 'object' && Array.isArray(i.plugins)) {
        normalized = normalized.concat(i.plugins)
      } else if (typeof i === 'object' && i.postcssPlugin) {
        normalized.push(i)
      } else if (typeof i === 'function') {
        normalized.push(i)
      } else if (typeof i === 'object' && (i.parse || i.stringify)) {
        if (true) {
          throw new Error(
            'PostCSS syntaxes cannot be used as plugins. Instead, please use ' +
              'one of the syntax/parser/stringifier options as outlined ' +
              'in your PostCSS runner documentation.'
          )
        }
      } else {
        throw new Error(i + ' is not a PostCSS plugin')
      }
    }
    return normalized
  }

  process(css, opts = {}) {
    if (
      !this.plugins.length &&
      !opts.parser &&
      !opts.stringifier &&
      !opts.syntax
    ) {
      return new NoWorkResult(this, css, opts)
    } else {
      return new LazyResult(this, css, opts)
    }
  }

  use(plugin) {
    this.plugins = this.plugins.concat(this.normalize([plugin]))
    return this
  }
}

module.exports = Processor
Processor.default = Processor

Root.registerProcessor(Processor)
Document.registerProcessor(Processor)


/***/ },

/***/ "./node_modules/postcss/lib/result.js"
/*!********************************************!*\
  !*** ./node_modules/postcss/lib/result.js ***!
  \********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Warning = __webpack_require__(/*! ./warning */ "./node_modules/postcss/lib/warning.js")

class Result {
  get content() {
    return this.css
  }

  constructor(processor, root, opts) {
    this.processor = processor
    this.messages = []
    this.root = root
    this.opts = opts
    this.css = ''
    this.map = undefined
  }

  toString() {
    return this.css
  }

  warn(text, opts = {}) {
    if (!opts.plugin) {
      if (this.lastPlugin && this.lastPlugin.postcssPlugin) {
        opts.plugin = this.lastPlugin.postcssPlugin
      }
    }

    let warning = new Warning(text, opts)
    this.messages.push(warning)

    return warning
  }

  warnings() {
    return this.messages.filter(i => i.type === 'warning')
  }
}

module.exports = Result
Result.default = Result


/***/ },

/***/ "./node_modules/postcss/lib/root.js"
/*!******************************************!*\
  !*** ./node_modules/postcss/lib/root.js ***!
  \******************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Container = __webpack_require__(/*! ./container */ "./node_modules/postcss/lib/container.js")

let LazyResult, Processor

class Root extends Container {
  constructor(defaults) {
    super(defaults)
    this.type = 'root'
    if (!this.nodes) this.nodes = []
  }

  normalize(child, sample, type) {
    let keepBefore = new Set()
    for (let node of Array.isArray(child) ? child : [child]) {
      if (
        node &&
        typeof node === 'object' &&
        !node.parent &&
        node.raws &&
        typeof node.raws.before !== 'undefined'
      ) {
        keepBefore.add(node.raws)
      }
    }

    let nodes = super.normalize(child)

    if (sample) {
      if (type === 'prepend') {
        if (this.nodes.length > 1) {
          sample.raws.before = this.nodes[1].raws.before
        } else {
          delete sample.raws.before
        }
      } else if (this.first !== sample) {
        for (let node of nodes) {
          if (!keepBefore.has(node.raws)) {
            node.raws.before = sample.raws.before
          }
        }
      }
    }

    return nodes
  }

  removeChild(child, ignore) {
    let index = this.index(child)

    if (!ignore && index === 0 && this.nodes.length > 1) {
      this.nodes[1].raws.before = this.nodes[index].raws.before
    }

    return super.removeChild(child)
  }

  toResult(opts = {}) {
    let lazy = new LazyResult(new Processor(), this, opts)
    return lazy.stringify()
  }
}

Root.registerLazyResult = dependant => {
  LazyResult = dependant
}

Root.registerProcessor = dependant => {
  Processor = dependant
}

module.exports = Root
Root.default = Root

Container.registerRoot(Root)


/***/ },

/***/ "./node_modules/postcss/lib/rule.js"
/*!******************************************!*\
  !*** ./node_modules/postcss/lib/rule.js ***!
  \******************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Container = __webpack_require__(/*! ./container */ "./node_modules/postcss/lib/container.js")
let list = __webpack_require__(/*! ./list */ "./node_modules/postcss/lib/list.js")

class Rule extends Container {
  get selectors() {
    return list.comma(this.selector)
  }

  set selectors(values) {
    let match = this.selector ? this.selector.match(/,\s*/) : null
    let sep = match ? match[0] : ',' + this.raw('between', 'beforeOpen')
    this.selector = values.join(sep)
  }

  constructor(defaults) {
    super(defaults)
    this.type = 'rule'
    if (!this.nodes) this.nodes = []
  }
}

module.exports = Rule
Rule.default = Rule

Container.registerRule(Rule)


/***/ },

/***/ "./node_modules/postcss/lib/stringifier.js"
/*!*************************************************!*\
  !*** ./node_modules/postcss/lib/stringifier.js ***!
  \*************************************************/
(module) {

"use strict";


// Characters that end an at-rule name, mirroring RE_AT_END in the tokenizer.
// Params starting with anything else need a space to stay separate tokens.
const AT_NAME_END = /[\t\n\f\r "#'()/;[\\\]{}]/

const DEFAULT_RAW = {
  after: '\n',
  beforeClose: '\n',
  beforeComment: '\n',
  beforeDecl: '\n',
  beforeOpen: ' ',
  beforeRule: '\n',
  colon: ': ',
  commentLeft: ' ',
  commentRight: ' ',
  emptyBody: '',
  indent: '    ',
  semicolon: false
}

function capitalize(str) {
  return str[0].toUpperCase() + str.slice(1)
}

function atruleStart(str, node) {
  let name = '@' + node.name
  let params = node.params ? str.rawValue(node, 'params') : ''
  let afterName = node.raws.afterName

  if (typeof afterName === 'undefined') {
    afterName = params ? ' ' : ''
  } else if (afterName === '' && params && !AT_NAME_END.test(params[0])) {
    afterName = ' '
  }

  return name + afterName + params
}

// `*--x` is not a custom property: the parser checks the first token, and the
// `*`/`_` hack prefix moves from `prop` into `before` only after that. A free
// semicolon in front of the declaration also ends up in `before`.
function isCustomProperty(node) {
  if (!node.prop.startsWith('--')) return false
  let before = node.raws.before
  return typeof before === 'undefined' || !/[^\s;]$/.test(before)
}

function pushBody(str, stack, node) {
  let nodes = node.nodes
  let last = nodes.length - 1
  while (last > 0) {
    if (nodes[last].type !== 'comment') break
    last -= 1
  }

  let semicolon = str.raw(node, 'semicolon')
  let isDocument = node.type === 'document'
  for (let i = nodes.length - 1; i >= 0; i--) {
    let child = nodes[i]
    let childSemicolon = last !== i || semicolon
    // A childless at-rule or a custom property declaration that still has
    // following siblings must be terminated. Without the semicolon those
    // trailing comments are folded into the at-rule's prelude or the custom
    // property's value and disappear when the output is re-parsed.
    if (
      !childSemicolon &&
      i < nodes.length - 1 &&
      ((child.type === 'atrule' && !child.nodes) ||
        (child.type === 'decl' && isCustomProperty(child)))
    ) {
      childSemicolon = true
    }
    stack.push({
      document: isDocument,
      node: child,
      semicolon: childSemicolon
    })
  }
}

function pushBlock(str, stack, node, start) {
  let between = str.raw(node, 'between', 'beforeOpen')
  str.builder(start + between + '{', node, 'start')

  let hasNodes = node.nodes && node.nodes.length
  let close = () => {
    let after = hasNodes
      ? str.raw(node, 'after')
      : str.raw(node, 'after', 'emptyBody')
    if (after) str.builder(after)
    str.builder('}', node, 'end')
    if (node.type === 'rule' && node.raws.ownSemicolon) {
      str.builder(node.raws.ownSemicolon, node, 'end')
    }
  }

  if (hasNodes) {
    stack.push(close)
    pushBody(str, stack, node)
  } else {
    close()
  }
}

class Stringifier {
  constructor(builder) {
    this.builder = builder
  }

  atrule(node, semicolon) {
    let start = atruleStart(this, node)
    if (node.nodes) {
      this.block(node, start)
    } else {
      let end = (node.raws.between || '') + (semicolon ? ';' : '')
      this.builder(start + end, node)
    }
  }

  beforeAfter(node, detect) {
    let value
    if (node.type === 'decl') {
      value = this.raw(node, null, 'beforeDecl')
    } else if (node.type === 'comment') {
      value = this.raw(node, null, 'beforeComment')
    } else if (detect === 'before') {
      value = this.raw(node, null, 'beforeRule')
    } else {
      value = this.raw(node, null, 'beforeClose')
    }

    let buf = node.parent
    let depth = 0
    while (buf && buf.type !== 'root') {
      depth += 1
      buf = buf.parent
    }

    if (value.includes('\n')) {
      let indent = this.raw(node, null, 'indent')
      if (indent.length) {
        for (let step = 0; step < depth; step++) value += indent
      }
    }

    return value
  }

  block(node, start) {
    let between = this.raw(node, 'between', 'beforeOpen')
    this.builder(start + between + '{', node, 'start')

    let after
    if (node.nodes && node.nodes.length) {
      this.body(node)
      after = this.raw(node, 'after')
    } else {
      after = this.raw(node, 'after', 'emptyBody')
    }

    if (after) this.builder(after)
    this.builder('}', node, 'end')
  }

  body(node) {
    // Rules and at-rules are expanded into an explicit stack instead of
    // recursive `stringify()` calls to survive deeply nested trees.
    // If a subclass changes the traversal methods, its children go
    // through `stringify()` to keep the override in charge.
    let proto = Stringifier.prototype
    let expandable = ['atrule', 'block', 'body', 'rule', 'stringify'].every(
      method => this[method] === proto[method]
    )

    let stack = []
    pushBody(this, stack, node)

    while (stack.length > 0) {
      let entry = stack.pop()
      if (typeof entry === 'function') {
        entry()
        continue
      }

      let child = entry.node
      let before = this.raw(child, 'before')
      if (before) {
        this.builder(before)
      }

      if (expandable && child.type === 'rule') {
        pushBlock(this, stack, child, this.rawValue(child, 'selector'))
      } else if (expandable && child.type === 'atrule' && child.nodes) {
        pushBlock(this, stack, child, atruleStart(this, child))
      } else {
        this.stringify(child, entry.semicolon)
      }
    }
  }

  comment(node) {
    let left = this.raw(node, 'left', 'commentLeft')
    let right = this.raw(node, 'right', 'commentRight')
    this.builder('/*' + left + node.text + right + '*/', node)
  }

  decl(node, semicolon) {
    let raws = node.raws
    let between = this.raw(node, 'between', 'colon')

    let string = node.prop + between + this.rawValue(node, 'value')

    if (node.important) {
      string += raws.important || ' !important'
    }

    if (semicolon) string += ';'
    this.builder(string, node)
  }

  document(node) {
    this.body(node)
  }

  raw(node, own, detect) {
    let value
    if (!detect) detect = own

    // Already had
    if (own) {
      value = node.raws[own]
      if (typeof value !== 'undefined') return value
    }

    let parent = node.parent

    if (detect === 'before') {
      // Hack for first rule in CSS
      if (!parent || (parent.type === 'root' && parent.first === node)) {
        return ''
      }

      // `root` nodes in `document` should use only their own raws
      if (parent && parent.type === 'document') {
        return ''
      }
    }

    // Floating child without parent
    if (!parent) return DEFAULT_RAW[detect]

    // Detect style by other nodes
    let root = node.root()
    let cache = root.rawCache || (root.rawCache = {})
    if (typeof cache[detect] !== 'undefined') {
      return cache[detect]
    }

    if (detect === 'before' || detect === 'after') {
      return this.beforeAfter(node, detect)
    } else {
      let method = 'raw' + capitalize(detect)
      if (this[method]) {
        value = this[method](root, node)
      } else {
        root.walk(i => {
          value = i.raws[own]
          if (typeof value !== 'undefined') return false
        })
      }
    }

    if (typeof value === 'undefined') value = DEFAULT_RAW[detect]

    cache[detect] = value
    return value
  }

  rawBeforeClose(root) {
    let value
    root.walk(i => {
      if (i.nodes && i.nodes.length > 0) {
        if (typeof i.raws.after !== 'undefined') {
          value = i.raws.after
          if (value.includes('\n')) {
            value = value.replace(/[^\n]+$/, '')
          }
          return false
        }
      }
    })
    if (value) value = value.replace(/\S/g, '')
    return value
  }

  rawBeforeComment(root, node) {
    let value
    root.walkComments(i => {
      if (typeof i.raws.before !== 'undefined') {
        value = i.raws.before
        if (value.includes('\n')) {
          value = value.replace(/[^\n]+$/, '')
        }
        return false
      }
    })
    if (typeof value === 'undefined') {
      value = this.raw(node, null, 'beforeDecl')
    } else if (value) {
      value = value.replace(/\S/g, '')
    }
    return value
  }

  rawBeforeDecl(root, node) {
    let value
    root.walkDecls(i => {
      if (typeof i.raws.before !== 'undefined') {
        value = i.raws.before
        if (value.includes('\n')) {
          value = value.replace(/[^\n]+$/, '')
        }
        return false
      }
    })
    if (typeof value === 'undefined') {
      value = this.raw(node, null, 'beforeRule')
    } else if (value) {
      value = value.replace(/\S/g, '')
    }
    return value
  }

  rawBeforeOpen(root) {
    let value
    root.walk(i => {
      if (i.type !== 'decl') {
        value = i.raws.between
        if (typeof value !== 'undefined') return false
      }
    })
    return value
  }

  rawBeforeRule(root) {
    let value
    root.walk(i => {
      if (i.nodes && (i.parent !== root || root.first !== i)) {
        if (typeof i.raws.before !== 'undefined') {
          value = i.raws.before
          if (value.includes('\n')) {
            value = value.replace(/[^\n]+$/, '')
          }
          return false
        }
      }
    })
    if (value) value = value.replace(/\S/g, '')
    return value
  }

  rawColon(root) {
    let value
    root.walkDecls(i => {
      if (typeof i.raws.between !== 'undefined') {
        value = i.raws.between.replace(/[^\s:]/g, '')
        return false
      }
    })
    return value
  }

  rawEmptyBody(root) {
    let value
    root.walk(i => {
      if (i.nodes && i.nodes.length === 0) {
        value = i.raws.after
        if (typeof value !== 'undefined') return false
      }
    })
    return value
  }

  rawIndent(root) {
    if (root.raws.indent) return root.raws.indent
    let value
    root.walk(i => {
      let p = i.parent
      if (p && p !== root && p.parent && p.parent === root) {
        if (typeof i.raws.before !== 'undefined') {
          let parts = i.raws.before.split('\n')
          value = parts[parts.length - 1]
          value = value.replace(/\S/g, '')
          return false
        }
      }
    })
    return value
  }

  rawSemicolon(root) {
    let value
    root.walk(i => {
      if (i.nodes && i.nodes.length && i.last.type === 'decl') {
        value = i.raws.semicolon
        if (typeof value !== 'undefined') return false
      }
    })
    return value
  }

  rawValue(node, prop) {
    let value = node[prop]
    let raw = node.raws[prop]
    if (raw && raw.value === value) {
      return raw.raw
    }

    return value
  }

  root(node) {
    let inDocument = node.parent && node.parent.type === 'document'
    if (!inDocument && node.source && node.source.input.hasBOM) {
      this.builder('\uFEFF', node, 'start')
    }
    this.body(node)
    if (node.raws.after) {
      this.builder(node.raws.after)
    }
  }

  rule(node) {
    this.block(node, this.rawValue(node, 'selector'))
    if (node.raws.ownSemicolon) {
      this.builder(node.raws.ownSemicolon, node, 'end')
    }
  }

  stringify(node, semicolon) {
    /* c8 ignore start */
    if (!this[node.type]) {
      throw new Error(
        'Unknown AST node type ' +
          node.type +
          '. ' +
          'Maybe you need to change PostCSS stringifier.'
      )
    }
    /* c8 ignore stop */
    this[node.type](node, semicolon)
  }
}

module.exports = Stringifier
Stringifier.default = Stringifier


/***/ },

/***/ "./node_modules/postcss/lib/stringify.js"
/*!***********************************************!*\
  !*** ./node_modules/postcss/lib/stringify.js ***!
  \***********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Stringifier = __webpack_require__(/*! ./stringifier */ "./node_modules/postcss/lib/stringifier.js")

const STYLE_TAG = /(<)(\/?style\b)/gi
const COMMENT_OPEN = /(<)(!--)/g

function escapeHTMLInCSS(str) {
  if (!str.includes('<')) return str
  return str.replace(STYLE_TAG, '\\3c $2').replace(COMMENT_OPEN, '\\3c $2')
}

class SafeStringifier extends Stringifier {
  escapeHTML(node, print) {
    let builder = this.builder
    let chunks, css
    this.builder = (str, child, type) => {
      if (chunks) {
        css += str
        chunks.push(str, child, type)
      } else if (str.includes('<')) {
        // Dangerous sequences start with `<`, so everything before
        // the first `<` is safe to pass through. The rest is buffered
        // to escape it as a whole.
        css = str
        chunks = [str, child, type]
      } else {
        builder(str, child, type)
      }
    }
    print()
    this.builder = builder
    if (!chunks) return

    let escaped = escapeHTMLInCSS(css)
    if (escaped === css) {
      // Keep the chunks to get a precise source map
      for (let i = 0; i < chunks.length; i += 3) {
        builder(chunks[i], chunks[i + 1], chunks[i + 2])
      }
    } else {
      // Escaping happens only on a hack attempt, source map is not important
      builder(escaped, node)
    }
  }

  root(node) {
    if (node.parent && node.parent.type === 'document') {
      // Document raws around the Root hold markup and are kept as is since CSS in Document can be marked with <style>
      this.escapeHTML(node, () => this.body(node))
      if (node.raws.after) this.builder(node.raws.after)
    } else {
      this.escapeHTML(node, () => super.root(node))
    }
  }
}

function stringify(node, builder) {
  let str = new SafeStringifier(builder)
  // Root escapes its own output and keeps markup in Document raws
  if (node.type === 'root' || node.type === 'document') {
    str.stringify(node)
  } else {
    str.escapeHTML(node, () => str.stringify(node))
  }
}

module.exports = stringify
stringify.default = stringify


/***/ },

/***/ "./node_modules/postcss/lib/symbols.js"
/*!*********************************************!*\
  !*** ./node_modules/postcss/lib/symbols.js ***!
  \*********************************************/
(module) {

"use strict";


module.exports.isClean = Symbol('isClean')

module.exports.my = Symbol('my')


/***/ },

/***/ "./node_modules/postcss/lib/tokenize.js"
/*!**********************************************!*\
  !*** ./node_modules/postcss/lib/tokenize.js ***!
  \**********************************************/
(module) {

"use strict";


const SINGLE_QUOTE = "'".charCodeAt(0)
const DOUBLE_QUOTE = '"'.charCodeAt(0)
const BACKSLASH = '\\'.charCodeAt(0)
const SLASH = '/'.charCodeAt(0)
const NEWLINE = '\n'.charCodeAt(0)
const SPACE = ' '.charCodeAt(0)
const FEED = '\f'.charCodeAt(0)
const TAB = '\t'.charCodeAt(0)
const CR = '\r'.charCodeAt(0)
const OPEN_SQUARE = '['.charCodeAt(0)
const CLOSE_SQUARE = ']'.charCodeAt(0)
const OPEN_PARENTHESES = '('.charCodeAt(0)
const CLOSE_PARENTHESES = ')'.charCodeAt(0)
const OPEN_CURLY = '{'.charCodeAt(0)
const CLOSE_CURLY = '}'.charCodeAt(0)
const SEMICOLON = ';'.charCodeAt(0)
const ASTERISK = '*'.charCodeAt(0)
const COLON = ':'.charCodeAt(0)
const AT = '@'.charCodeAt(0)

const RE_AT_END = /[\t\n\f\r "#'()/;[\\\]{}]/g
const RE_WORD_END = /[\t\n\f\r !"#'():;@[\\\]{}]|\/(?=\*)/g
const RE_BAD_BRACKET = /.[\r\n"'(/\\]/
const RE_HEX_ESCAPE = /[\da-f]/i

module.exports = function tokenizer(input, options = {}) {
  let css = input.css.valueOf()
  let ignore = options.ignoreErrors

  let code, content, escape, next, quote
  let currentToken, escaped, escapePos, n, prev

  let length = css.length
  let pos = 0
  let buffer = []
  let returned = []
  let lastBadParen = -1

  function position() {
    return pos
  }

  function unclosed(what) {
    throw input.error('Unclosed ' + what, pos)
  }

  function endOfFile() {
    return returned.length === 0 && pos >= length
  }

  function nextToken(opts) {
    if (returned.length) return returned.pop()
    if (pos >= length) return

    let ignoreUnclosed = opts ? opts.ignoreUnclosed : false

    code = css.charCodeAt(pos)

    switch (code) {
      case NEWLINE:
      case SPACE:
      case TAB:
      case CR:
      case FEED: {
        next = pos
        do {
          next += 1
          code = css.charCodeAt(next)
        } while (
          code === SPACE ||
          code === NEWLINE ||
          code === TAB ||
          code === CR ||
          code === FEED
        )

        currentToken = ['space', css.slice(pos, next)]
        pos = next - 1
        break
      }

      case OPEN_SQUARE:
      case CLOSE_SQUARE:
      case OPEN_CURLY:
      case CLOSE_CURLY:
      case COLON:
      case SEMICOLON:
      case CLOSE_PARENTHESES: {
        let controlChar = String.fromCharCode(code)
        currentToken = [controlChar, controlChar, pos]
        break
      }

      case OPEN_PARENTHESES: {
        prev = buffer.length ? buffer.pop()[1] : ''
        n = css.charCodeAt(pos + 1)
        if (
          prev === 'url' &&
          n !== SINGLE_QUOTE &&
          n !== DOUBLE_QUOTE &&
          n !== SPACE &&
          n !== NEWLINE &&
          n !== TAB &&
          n !== FEED &&
          n !== CR
        ) {
          next = pos
          do {
            escaped = false
            next = css.indexOf(')', next + 1)
            if (next === -1) {
              if (ignore || ignoreUnclosed) {
                next = pos
                break
              } else {
                unclosed('bracket')
              }
            }
            escapePos = next
            while (css.charCodeAt(escapePos - 1) === BACKSLASH) {
              escapePos -= 1
              escaped = !escaped
            }
          } while (escaped)

          currentToken = ['brackets', css.slice(pos, next + 1), pos, next]

          pos = next
        } else if (pos <= lastBadParen) {
          currentToken = ['(', '(', pos]
        } else {
          next = css.indexOf(')', pos + 1)
          content = css.slice(pos, next + 1)

          if (next === -1 || RE_BAD_BRACKET.test(content)) {
            lastBadParen = next === -1 ? length : next
            currentToken = ['(', '(', pos]
          } else {
            currentToken = ['brackets', content, pos, next]
            pos = next
          }
        }

        break
      }

      case SINGLE_QUOTE:
      case DOUBLE_QUOTE: {
        quote = code === SINGLE_QUOTE ? "'" : '"'
        next = pos
        do {
          escaped = false
          next = css.indexOf(quote, next + 1)
          if (next === -1) {
            if (ignore || ignoreUnclosed) {
              next = pos + 1
              break
            } else {
              unclosed('string')
            }
          }
          escapePos = next
          while (css.charCodeAt(escapePos - 1) === BACKSLASH) {
            escapePos -= 1
            escaped = !escaped
          }
        } while (escaped)

        currentToken = ['string', css.slice(pos, next + 1), pos, next]
        pos = next
        break
      }

      case AT: {
        RE_AT_END.lastIndex = pos + 1
        RE_AT_END.test(css)
        if (RE_AT_END.lastIndex === 0) {
          next = css.length - 1
        } else {
          next = RE_AT_END.lastIndex - 2
        }

        currentToken = ['at-word', css.slice(pos, next + 1), pos, next]

        pos = next
        break
      }

      case BACKSLASH: {
        next = pos
        escape = true
        while (css.charCodeAt(next + 1) === BACKSLASH) {
          next += 1
          escape = !escape
        }
        code = css.charCodeAt(next + 1)
        if (
          escape &&
          code !== SLASH &&
          code !== SPACE &&
          code !== NEWLINE &&
          code !== TAB &&
          code !== CR &&
          code !== FEED
        ) {
          next += 1
          if (RE_HEX_ESCAPE.test(css.charAt(next))) {
            while (RE_HEX_ESCAPE.test(css.charAt(next + 1))) {
              next += 1
            }
            if (css.charCodeAt(next + 1) === SPACE) {
              next += 1
            }
          }
        }

        currentToken = ['word', css.slice(pos, next + 1), pos, next]

        pos = next
        break
      }

      default: {
        if (code === SLASH && css.charCodeAt(pos + 1) === ASTERISK) {
          next = css.indexOf('*/', pos + 2) + 1
          if (next === 0) {
            if (ignore || ignoreUnclosed) {
              next = css.length
            } else {
              unclosed('comment')
            }
          }

          currentToken = ['comment', css.slice(pos, next + 1), pos, next]
          pos = next
        } else {
          RE_WORD_END.lastIndex = pos + 1
          RE_WORD_END.test(css)
          if (RE_WORD_END.lastIndex === 0) {
            next = css.length - 1
          } else {
            next = RE_WORD_END.lastIndex - 2
          }

          currentToken = ['word', css.slice(pos, next + 1), pos, next]
          buffer.push(currentToken)
          pos = next
        }

        break
      }
    }

    pos++
    return currentToken
  }

  function back(token) {
    returned.push(token)
  }

  return {
    back,
    endOfFile,
    nextToken,
    position
  }
}


/***/ },

/***/ "./node_modules/postcss/lib/warn-once.js"
/*!***********************************************!*\
  !*** ./node_modules/postcss/lib/warn-once.js ***!
  \***********************************************/
(module) {

"use strict";
/* eslint-disable no-console */


let printed = {}

module.exports = function warnOnce(message) {
  if (printed[message]) return
  printed[message] = true

  if (typeof console !== 'undefined' && console.warn) {
    console.warn(message)
  }
}


/***/ },

/***/ "./node_modules/postcss/lib/warning.js"
/*!*********************************************!*\
  !*** ./node_modules/postcss/lib/warning.js ***!
  \*********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


let Container = __webpack_require__(/*! ./container */ "./node_modules/postcss/lib/container.js")
let { my } = __webpack_require__(/*! ./symbols */ "./node_modules/postcss/lib/symbols.js")

class Warning {
  constructor(text, opts = {}) {
    this.type = 'warning'
    this.text = text

    if (opts.node && opts.node.source) {
      if (!opts.node[my]) {
        // The node comes from another PostCSS copy in node_modules, so it does
        // not have this copy’s methods. Container#normalize() rebuilds such
        // nodes on insert, but a node passed straight to Result#warn() never
        // goes through it.
        Container.rebuild(opts.node)
      }
      let range = opts.node.rangeBy(opts)
      this.line = range.start.line
      this.column = range.start.column
      this.endLine = range.end.line
      this.endColumn = range.end.column
    }

    for (let opt in opts) this[opt] = opts[opt]
  }

  toString() {
    if (this.node) {
      return this.node.error(this.text, {
        index: this.index,
        plugin: this.plugin,
        word: this.word
      }).message
    }

    if (this.plugin) {
      return this.plugin + ': ' + this.text
    }

    return this.text
  }
}

module.exports = Warning
Warning.default = Warning


/***/ },

/***/ "./node_modules/process/browser.js"
/*!*****************************************!*\
  !*** ./node_modules/process/browser.js ***!
  \*****************************************/
(module) {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ },

/***/ "./node_modules/sanitize-html/index.js"
/*!*********************************************!*\
  !*** ./node_modules/sanitize-html/index.js ***!
  \*********************************************/
(module, __unused_webpack_exports, __webpack_require__) {

const htmlparser = __webpack_require__(/*! htmlparser2 */ "./node_modules/sanitize-html/node_modules/htmlparser2/dist/index.js");
const escapeStringRegexp = __webpack_require__(/*! escape-string-regexp */ "./node_modules/escape-string-regexp/index.js");
const { isPlainObject } = __webpack_require__(/*! is-plain-object */ "./node_modules/is-plain-object/dist/is-plain-object.js");
const deepmerge = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");
const parseSrcset = __webpack_require__(/*! parse-srcset */ "./node_modules/parse-srcset/src/parse-srcset.js");
const { parse: postcssParse } = __webpack_require__(/*! postcss */ "./node_modules/postcss/lib/postcss.js");
const { naughtyHref: launderNaughtyHref } = __webpack_require__(/*! launder */ "./node_modules/launder/index.js");
// Tags that can conceivably represent stand-alone media.
const mediaTags = [
  'img', 'audio', 'video', 'picture', 'svg',
  'object', 'map', 'iframe', 'embed'
];
// Tags that are inherently vulnerable to being used in XSS attacks.
const vulnerableTags = [ 'script', 'style' ];
// SVG SMIL animation elements. These do not carry a URL themselves: they
// retarget an attribute of another element, naming it with `attributeName`
// and supplying the new value(s) in `values`, `from`, `to` and `by`.
const svgAnimationTags = [
  'animate', 'animatecolor', 'animatemotion', 'animatetransform', 'set'
];
// Attribute names that always name a URL sink, whatever
// `allowedSchemesAppliedToAttributes` has been narrowed to. A namespace prefix
// is ignored when matching, so `xlink:href` and any other prefixed spelling of
// `href` are covered.
const alwaysUrlAttributes = [ 'href' ];

// Our own diagnostics. A console-shaped `logger` option takes them instead of
// the console; missing methods fall back to it.
const severities = [ 'debug', 'info', 'warn', 'error' ];

function loggerFor(options) {
  const source = (options && options.logger) || console;
  const logger = {};
  for (const severity of severities) {
    logger[severity] = typeof source[severity] === 'function'
      ? (...args) => source[severity](...args)
      // eslint-disable-next-line no-console
      : (...args) => console[severity](...args);
  }
  return logger;
}

function each(obj, cb) {
  if (obj) {
    Object.keys(obj).forEach(function (key) {
      cb(obj[key], key);
    });
  }
}

// Avoid false positives with .__proto__, .hasOwnProperty, etc.
function has(obj, key) {
  return ({}).hasOwnProperty.call(obj, key);
}

// Returns those elements of `a` for which `cb(a)` returns truthy
function filter(a, cb) {
  const n = [];
  each(a, function(v) {
    if (cb(v)) {
      n.push(v);
    }
  });
  return n;
}

function isEmptyObject(obj) {
  for (const key in obj) {
    if (has(obj, key)) {
      return false;
    }
  }
  return true;
}

function stringifySrcset(parsedSrcset) {
  return parsedSrcset.map(function(part) {
    if (!part.url) {
      throw new Error('URL missing');
    }

    return (
      part.url +
      (part.w ? ` ${part.w}w` : '') +
      (part.h ? ` ${part.h}h` : '') +
      (part.d ? ` ${part.d}x` : '')
    );
  }).join(', ');
}

module.exports = sanitizeHtml;

// A valid attribute name.
// We use a tolerant definition based on the set of strings defined by
// html.spec.whatwg.org/multipage/parsing.html#before-attribute-name-state
// and html.spec.whatwg.org/multipage/parsing.html#attribute-name-state .
// The characters accepted are ones which can be appended to the attribute
// name buffer without triggering a parse error:
//   * unexpected-equals-sign-before-attribute-name
//   * unexpected-null-character
//   * unexpected-character-in-attribute-name
// We exclude the empty string because it's impossible to get to the after
// attribute name state with an empty attribute name buffer.
const VALID_HTML_ATTRIBUTE_NAME = /^[^\0\t\n\f\r /<=>]+$/;

// Ignore the _recursing flag; it's there for recursive
// invocation as a guard against this exploit:
// https://github.com/fb55/htmlparser2/issues/105

function sanitizeHtml(html, options, _recursing) {
  if (html == null) {
    return '';
  }
  if (typeof html === 'number') {
    html = html.toString();
  }

  let result = '';
  // Used for hot swapping the result variable with an empty string
  // in order to "capture" the text written to it.
  let tempResult = '';

  function Frame(tag, attribs) {
    const that = this;
    this.tag = tag;
    this.attribs = attribs || {};
    this.tagPosition = result.length;
    this.text = ''; // Node inner text
    this.openingTagLength = 0;
    this.mediaChildren = [];

    this.updateParentNodeText = function() {
      if (stack.length) {
        const parentFrame = stack[stack.length - 1];
        parentFrame.text += that.text;
      }
    };

    this.updateParentNodeMediaChildren = function() {
      if (stack.length && mediaTags.includes(this.tag)) {
        const parentFrame = stack[stack.length - 1];
        parentFrame.mediaChildren.push(this.tag);
      }
    };
  }

  options = Object.assign({}, sanitizeHtml.defaults, options);
  options.parser = Object.assign({}, htmlParserDefaults, options.parser);

  const logger = loggerFor(options);

  const tagAllowed = function (name) {
    return options.allowedTags === false ||
      (options.allowedTags || []).indexOf(name) > -1;
  };

  // vulnerableTags
  vulnerableTags.forEach(function (tag) {
    if (tagAllowed(tag) && !options.allowVulnerableTags) {
      logger.warn(
        `Your \`allowedTags\` option includes \`${tag}\`, which is inherently ` +
        'vulnerable to XSS attacks. Please remove it from `allowedTags`, or, ' +
        'to disable this warning, add the `allowVulnerableTags` option and ' +
        'ensure you are accounting for this risk.'
      );
    }
  });

  // Tags that contain something other than HTML, or where discarding
  // the text when the tag is disallowed makes sense for other reasons.
  // If we are not allowing these tags, we should drop their content too.
  // For other tags you would drop the tag but keep its content.
  // `xmp` is included because htmlparser2 treats it as a raw-text element,
  // so markup inside is parsed as text on input but would otherwise be
  // re-emitted unescaped via the `ontext` branch below, allowing XSS bypass
  // when `xmp` is disallowed (which is the default).
  const nonTextTagsArray = options.nonTextTags || [
    'script',
    'style',
    'textarea',
    'option',
    'xmp'
  ];
  let allowedAttributesMap;
  let allowedAttributesGlobMap;
  if (options.allowedAttributes) {
    allowedAttributesMap = {};
    allowedAttributesGlobMap = {};
    each(options.allowedAttributes, function(attributes, tag) {
      allowedAttributesMap[tag] = [];
      const globRegex = [];
      attributes.forEach(function(obj) {
        if (typeof obj === 'string' && obj.indexOf('*') >= 0) {
          globRegex.push(escapeStringRegexp(obj).replace(/\\\*/g, '.*'));
        } else {
          allowedAttributesMap[tag].push(obj);
        }
      });
      if (globRegex.length) {
        allowedAttributesGlobMap[tag] = new RegExp('^(' + globRegex.join('|') + ')$');
      }
    });
  }
  const allowedClassesMap = {};
  const allowedClassesGlobMap = {};
  const allowedClassesRegexMap = {};
  each(options.allowedClasses, function(classes, tag) {
    // Implicitly allows the class attribute
    if (allowedAttributesMap) {
      if (!has(allowedAttributesMap, tag)) {
        allowedAttributesMap[tag] = [];
      }
      allowedAttributesMap[tag].push('class');
    }

    allowedClassesMap[tag] = classes;

    if (Array.isArray(classes)) {
      const globRegex = [];
      allowedClassesMap[tag] = [];
      allowedClassesRegexMap[tag] = [];
      classes.forEach(function(obj) {
        if (typeof obj === 'string' && obj.indexOf('*') >= 0) {
          globRegex.push(escapeStringRegexp(obj).replace(/\\\*/g, '.*'));
        } else if (obj instanceof RegExp) {
          allowedClassesRegexMap[tag].push(obj);
        } else {
          allowedClassesMap[tag].push(obj);
        }
      });
      if (globRegex.length) {
        allowedClassesGlobMap[tag] = new RegExp('^(' + globRegex.join('|') + ')$');
      }
    }
  });

  const transformTagsMap = {};
  let transformTagsAll;
  each(options.transformTags, function(transform, tag) {
    let transFun;
    if (typeof transform === 'function') {
      transFun = transform;
    } else if (typeof transform === 'string') {
      transFun = sanitizeHtml.simpleTransform(transform);
    }
    if (tag === '*') {
      transformTagsAll = transFun;
    } else {
      transformTagsMap[tag] = transFun;
    }
  });

  let depth;
  let stack;
  let skipMap;
  let transformMap;
  let skipText;
  let skipTextDepth;
  // Browsers (with scripting enabled) parse <noscript> content as raw text up
  // to the first `</noscript`, but htmlparser2 parses it as markup, so an end
  // tag for an ancestor can make htmlparser2 close the <noscript> implicitly
  // much earlier. `rawTextEnd` is the source offset where the browser ends the
  // <noscript> being discarded, and `skipRawText` is set while htmlparser2 has
  // already closed it but the browser has not, so that we keep discarding
  // until we reach that offset (GHSA-x3q4-9hxx-gx8m).
  let rawTextEnd;
  let skipRawText;
  let addedText = false;

  initializeState();

  const parser = new htmlparser.Parser({
    onopentag: function(name, attribs) {
      if (options.onOpenTag) {
        options.onOpenTag(name, attribs);
      }
      updateRawTextRegion();

      // If `enforceHtmlBoundary` is `true` and this has found the opening
      // `html` tag, reset the state.
      if (options.enforceHtmlBoundary && name === 'html') {
        initializeState();
      }

      if (skipRawText) {
        return;
      }
      if (skipText) {
        skipTextDepth++;
        return;
      }
      const frame = new Frame(name, attribs);
      stack.push(frame);

      let skip = false;
      const hasText = !!frame.text;
      let transformedTag;
      if (has(transformTagsMap, name)) {
        transformedTag = transformTagsMap[name](name, attribs);

        frame.attribs = attribs = transformedTag.attribs;

        if (transformedTag.text !== undefined) {
          frame.innerText = transformedTag.text;
        }

        if (name !== transformedTag.tagName) {
          frame.name = name = transformedTag.tagName;
          transformMap[depth] = transformedTag.tagName;
        }
      }
      if (transformTagsAll) {
        transformedTag = transformTagsAll(name, attribs);

        frame.attribs = attribs = transformedTag.attribs;
        if (name !== transformedTag.tagName) {
          frame.name = name = transformedTag.tagName;
          transformMap[depth] = transformedTag.tagName;
        }
      }

      if (!tagAllowed(name) || animatesUrlAttribute(name, attribs) || (options.disallowedTagsMode === 'recursiveEscape' && !isEmptyObject(skipMap)) || (options.nestingLimit != null && depth >= options.nestingLimit)) {
        skip = true;
        skipMap[depth] = true;
        if (options.disallowedTagsMode === 'discard' || options.disallowedTagsMode === 'completelyDiscard') {
          if (nonTextTagsArray.indexOf(name) !== -1) {
            skipText = true;
            skipTextDepth = 1;
            if (frame.tag.toLowerCase() === 'noscript') {
              rawTextEnd = findRawTextEnd('noscript', parser.endIndex + 1);
            }
          }
        }
      }
      depth++;
      if (skip) {
        if (options.disallowedTagsMode === 'discard' || options.disallowedTagsMode === 'completelyDiscard') {
          // We want the contents but not this tag
          if (frame.innerText && !hasText) {
            const escaped = escapeHtml(frame.innerText);
            if (options.textFilter) {
              result += options.textFilter(escaped, name);
            } else {
              result += escaped;
            }
            addedText = true;
          }
          return;
        }
        tempResult = result;
        result = '';
      }
      result += '<' + name;

      if (name === 'script') {
        if (options.allowedScriptHostnames || options.allowedScriptDomains) {
          frame.innerText = '';
        }
      }

      const isBeingEscaped = skip && (options.disallowedTagsMode === 'escape' || options.disallowedTagsMode === 'recursiveEscape');
      const shouldPreserveEscapedAttributes = isBeingEscaped &&
        options.preserveEscapedAttributes;

      if (shouldPreserveEscapedAttributes) {
        each(attribs, function(value, a) {
          result += ' ' + a + '="' + escapeHtml((value || ''), true) + '"';
        });
      } else if (!allowedAttributesMap || has(allowedAttributesMap, name) || allowedAttributesMap['*']) {
        each(attribs, function(value, a) {
          if (!VALID_HTML_ATTRIBUTE_NAME.test(a)) {
            // This prevents part of an attribute name in the output from being
            // interpreted as the end of an attribute, or end of a tag.
            delete frame.attribs[a];
            return;
          }
          // If the value is empty, check if the attribute is
          // in the allowedEmptyAttributes array.
          // If it is not in the allowedEmptyAttributes array,
          // and it is a known non-boolean attribute, delete it
          // List taken from https://html.spec.whatwg.org/multipage/indices.html#attributes-3
          if (value === '' && (!options.allowedEmptyAttributes.includes(a)) &&
            (options.nonBooleanAttributes.includes(a) || options.nonBooleanAttributes.includes('*'))) {
            delete frame.attribs[a];
            return;
          }
          // check allowedAttributesMap for the element and attribute and modify the value
          // as necessary if there are specific values defined.
          let passedAllowedAttributesMapCheck = false;
          if (!allowedAttributesMap ||
            (has(allowedAttributesMap, name) &&
              allowedAttributesMap[name].indexOf(a) !== -1) ||
            (allowedAttributesMap['*'] && allowedAttributesMap['*'].indexOf(a) !== -1) ||
            (has(allowedAttributesGlobMap, name) &&
              allowedAttributesGlobMap[name].test(a)) ||
            (allowedAttributesGlobMap['*'] && allowedAttributesGlobMap['*'].test(a))) {
            passedAllowedAttributesMapCheck = true;
          } else if (allowedAttributesMap && allowedAttributesMap[name]) {
            for (const o of allowedAttributesMap[name]) {
              if (isPlainObject(o) && o.name && (o.name === a)) {
                passedAllowedAttributesMapCheck = true;
                let newValue = '';
                if (o.multiple === true) {
                  // verify the values that are allowed
                  const splitStrArray = value.split(' ');
                  for (const s of splitStrArray) {
                    if (o.values.indexOf(s) !== -1) {
                      if (newValue === '') {
                        newValue = s;
                      } else {
                        newValue += ' ' + s;
                      }
                    }
                  }
                } else if (o.values.indexOf(value) >= 0) {
                  // verified an allowed value matches the entire attribute value
                  newValue = value;
                }
                value = newValue;
              }
            }
          }
          if (passedAllowedAttributesMapCheck) {
            if (options.allowedSchemesAppliedToAttributes.indexOf(a) !== -1) {
              if (naughtyHref(name, value)) {
                delete frame.attribs[a];
                return;
              }
            }

            // `<meta http-equiv="refresh" content="0;url=...">` navigates to a
            // URL embedded in `content`, so scheme check that URL too
            // (GHSA-cv27-6wvh-8x7j). Other meta `content` values are left alone.
            if (name === 'meta' && a.toLowerCase() === 'content' && isRefresh(attribs) && naughtyRefresh(value)) {
              delete frame.attribs[a];
              return;
            }

            if (name === 'script' && a === 'src') {

              let allowed = true;

              try {
                const parsed = parseUrl(value);

                if (options.allowedScriptHostnames || options.allowedScriptDomains) {
                  const allowedHostname = (options.allowedScriptHostnames || [])
                    .find(function (hostname) {
                      return hostname === parsed.url.hostname;
                    });
                  const allowedDomain = (options.allowedScriptDomains || [])
                    .find(function(domain) {
                      return parsed.url.hostname === domain || parsed.url.hostname.endsWith(`.${domain}`);
                    });
                  allowed = allowedHostname || allowedDomain;
                }
              } catch (e) {
                allowed = false;
              }

              if (!allowed) {
                delete frame.attribs[a];
                return;
              }
            }

            if (name === 'iframe' && a === 'src') {
              let allowed = true;
              try {
                const parsed = parseUrl(value);

                if (parsed.isRelativeUrl) {
                  // default value of allowIframeRelativeUrls is true
                  // unless allowedIframeHostnames or allowedIframeDomains specified
                  allowed = has(options, 'allowIframeRelativeUrls')
                    ? options.allowIframeRelativeUrls
                    : (!options.allowedIframeHostnames && !options.allowedIframeDomains);
                } else if (
                  options.allowedIframeHostnames ||
                  options.allowedIframeDomains
                ) {
                  const allowedHostname = (options.allowedIframeHostnames || [])
                    .find(function (hostname) {
                      return hostname === parsed.url.hostname;
                    });
                  const allowedDomain = (options.allowedIframeDomains || [])
                    .find(function(domain) {
                      return parsed.url.hostname === domain || parsed.url.hostname.endsWith(`.${domain}`);
                    });
                  allowed = allowedHostname || allowedDomain;
                }
              } catch (e) {
                // Unparseable iframe src
                allowed = false;
              }
              if (!allowed) {
                delete frame.attribs[a];
                return;
              }
            }
            if (a === 'srcset' || a === 'imagesrcset') {
              try {
                let parsed = parseSrcset(value);
                parsed.forEach(function(value) {
                  if (naughtyHref(name, value.url)) {
                    value.evil = true;
                  }
                });
                parsed = filter(parsed, function(v) {
                  return !v.evil;
                });
                if (!parsed.length) {
                  delete frame.attribs[a];
                  return;
                } else {
                  value = stringifySrcset(filter(parsed, function(v) {
                    return !v.evil;
                  }));
                  frame.attribs[a] = value;
                }
              } catch (e) {
                // Unparseable srcset
                delete frame.attribs[a];
                return;
              }
            }
            if (a === 'class') {
              const allowedSpecificClasses = allowedClassesMap[name];
              const allowedWildcardClasses = allowedClassesMap['*'];
              const allowedSpecificClassesGlob = allowedClassesGlobMap[name];
              const allowedSpecificClassesRegex = allowedClassesRegexMap[name];
              const allowedWildcardClassesRegex = allowedClassesRegexMap['*'];
              const allowedWildcardClassesGlob = allowedClassesGlobMap['*'];
              const allowedClassesGlobs = [
                allowedSpecificClassesGlob,
                allowedWildcardClassesGlob
              ]
                .concat(allowedSpecificClassesRegex, allowedWildcardClassesRegex)
                .filter(function (t) {
                  return t;
                });
              if (allowedSpecificClasses && allowedWildcardClasses) {
                value = filterClasses(
                  value,
                  deepmerge(allowedSpecificClasses, allowedWildcardClasses),
                  allowedClassesGlobs
                );
              } else {
                value = filterClasses(
                  value,
                  allowedSpecificClasses || allowedWildcardClasses,
                  allowedClassesGlobs
                );
              }
              if (!value.length) {
                delete frame.attribs[a];
                return;
              }
            }
            if (a === 'style') {
              if (options.parseStyleAttributes) {
                try {
                  const abstractSyntaxTree = postcssParse(name + ' {' + value + '}', { map: false });
                  const filteredAST = filterCss(
                    abstractSyntaxTree,
                    options.allowedStyles
                  );

                  value = stringifyStyleAttributes(filteredAST);

                  if (value.length === 0) {
                    delete frame.attribs[a];
                    return;
                  }
                } catch (e) {
                  if (typeof window !== 'undefined') {
                    logger.warn(
                      `Failed to parse "${name} {${value}}". If you are ` +
                      'running this in a browser, we recommend disabling ' +
                      'style parsing with the parseStyleAttributes option, ' +
                      'since it only works in a node environment due to a ' +
                      'postcss dependency. More info: ' +
                      'https://github.com/apostrophecms/sanitize-html/issues/547'
                    );
                  }
                  delete frame.attribs[a];
                  return;
                }
              } else if (options.allowedStyles) {
                throw new Error('allowedStyles option cannot be used together with parseStyleAttributes: false.');
              }
            }
            result += ' ' + a;
            if (value && value.length) {
              result += '="' + escapeHtml(value, true) + '"';
            } else if (options.allowedEmptyAttributes.includes(a)) {
              result += '=""';
            }
          } else {
            delete frame.attribs[a];
          }
        });
      }
      if (options.selfClosing.indexOf(name) !== -1) {
        result += ' />';
      } else {
        result += '>';
        if (frame.innerText && !hasText) {
          const escaped = escapeHtml(frame.innerText);
          if (options.textFilter) {
            result += options.textFilter(escaped, name);
          } else {
            result += escaped;
          }
          addedText = true;
        }
      }
      if (skip) {
        result = tempResult + escapeHtml(result);
        tempResult = '';
      }
      frame.openingTagLength = result.length - frame.tagPosition;
    },
    ontext: function(text) {
      updateRawTextRegion();
      if (skipText || skipRawText) {
        return;
      }
      const lastFrame = stack[stack.length - 1];
      let tag;

      if (lastFrame) {
        tag = lastFrame.tag;
        // If inner text was set by transform function then let's use it
        text = lastFrame.innerText !== undefined ? lastFrame.innerText : text;
      }

      if (options.disallowedTagsMode === 'completelyDiscard' && !tagAllowed(tag)) {
        text = '';
      } else if (tag && tagAllowed(tag) && (options.disallowedTagsMode === 'discard' || options.disallowedTagsMode === 'completelyDiscard') && ((tag === 'script') || (tag === 'style'))) {
        // htmlparser2 gives us these as-is. Escaping them ruins the content. Allowing
        // script tags is, by definition, game over for XSS protection, so if that's
        // your concern, don't allow them. The same is essentially true for style tags
        // which have their own collection of XSS vectors.
        result += text;
      } else if (tag && tagAllowed(tag) && (options.disallowedTagsMode === 'discard' || options.disallowedTagsMode === 'completelyDiscard') && (tag === 'textarea' || tag === 'xmp')) {
        // <textarea> and <xmp> hold text that must not be re-emitted verbatim:
        // if a raw `<` survives into the output it can reopen a tag when the
        // result is re-parsed by a browser, smuggling non-allowlisted markup
        // through the allowlist (mutation-XSS, GHSA-jxwj-j7wr-gfrw — e.g. the
        // `</textarea/>` solidus mis-close). We therefore ALWAYS escape this
        // content rather than passing it through. Escaping unconditionally also
        // closes the related SVG/MathML foreign-content bypass (where the HTML5
        // parser treats <textarea>/<xmp> as ordinary foreign elements and a
        // browser re-parses their contents as live markup, e.g.
        // `<svg><textarea><img src=x onerror=alert(1)></textarea></svg>`): since
        // we never re-emit raw text for these tags, no namespace check is
        // needed. The two tags need different escaping because htmlparser2
        // tokenizes them differently:
        if (tag === 'xmp') {
          // <xmp> is a raw-text (CDATA) element: entities are NOT decoded, so
          // its content reaches us as raw source that is already entity-encoded.
          // Escape only the angle brackets so a literal `<` cannot reopen a tag,
          // while leaving `&` untouched to avoid double-encoding entities that
          // are already encoded in the source.
          result += text.replace(/</g, '&lt;').replace(/>/g, '&gt;');
        } else {
          // <textarea> is an RCDATA element: htmlparser2 (>= 11) decodes
          // entities inside it, so its content reaches us as plain decoded text.
          // It must therefore be fully escaped like any other text — escaping
          // `&` as well as `<`/`>` — so entities round-trip faithfully (no
          // double-encoding, see the CVE-2026-40186 regression tests) and no
          // `<` can reopen a tag.
          result += escapeHtml(text, false);
        }
        // Other "nonTextTags" like <option> are not raw text elements in
        // htmlparser2, so their contents are decoded and must be escaped below
        // like any other text (important to prevent XSS via entity-encoded
        // payloads such as <option>&lt;script&gt;...&lt;/script&gt;</option>).
      } else if (
        // htmlparser2 treats <iframe> as a raw-text element, so markup inside
        // (including after an unclosed <iframe>) arrives as a single text node.
        // When the iframe is discarded, re-sanitize that fallback markup as HTML
        // instead of escaping it as plain text (issue #5550).
        tag === 'iframe' &&
        !tagAllowed(tag) &&
        options.disallowedTagsMode === 'discard'
      ) {
        result += sanitizeHtml(text, options);
      } else if (!addedText) {
        const escaped = escapeHtml(text, false);
        if (options.textFilter) {
          result += options.textFilter(escaped, tag);
        } else {
          result += escaped;
        }
      }
      if (stack.length) {
        const frame = stack[stack.length - 1];
        frame.text += text;
      }
    },
    onclosetag: function(name, isImplied) {
      if (options.onCloseTag) {
        options.onCloseTag(name, isImplied);
      }

      updateRawTextRegion();
      if (skipRawText) {
        // Still inside the browser's raw text: only close elements that were
        // opened before the discarded region, so the output stays balanced.
        const lastFrame = stack[stack.length - 1];
        if (!lastFrame || lastFrame.tag !== name) {
          return;
        }
      } else if (skipText) {
        skipTextDepth--;
        if (!skipTextDepth) {
          skipText = false;
          if (rawTextEnd !== null) {
            // htmlparser2 closed the element implicitly (e.g. an ancestor's
            // end tag) before the browser would. Close its frame below, but
            // keep discarding up to the browser's end tag.
            skipRawText = true;
          }
        } else {
          return;
        }
      }

      const frame = stack.pop();
      if (!frame) {
        // Do not crash on bad markup
        return;
      }

      if (frame.tag !== name) {
        // Another case of bad markup.
        // Push to stack, so that it will be used in future closing tags.
        stack.push(frame);
        return;
      }

      skipText = options.enforceHtmlBoundary ? name === 'html' : false;
      depth--;
      const skip = skipMap[depth];
      if (skip) {
        delete skipMap[depth];
        if (options.disallowedTagsMode === 'discard' || options.disallowedTagsMode === 'completelyDiscard') {
          frame.updateParentNodeText();
          return;
        }
        tempResult = result;
        result = '';
      }

      if (transformMap[depth]) {
        name = transformMap[depth];
        delete transformMap[depth];
      }

      if (options.exclusiveFilter) {
        const filterResult = options.exclusiveFilter(frame);
        if (filterResult === 'excludeTag') {
          if (skip) {
            // no longer escaping the tag since it's not added at all
            result = tempResult;
            tempResult = '';
          }
          // remove the opening tag from the result
          result = result.substring(0, frame.tagPosition) +
            result.substring(frame.tagPosition + frame.openingTagLength);
          return;
        } else if (filterResult) {
          result = result.substring(0, frame.tagPosition);
          return;
        }
      }

      frame.updateParentNodeMediaChildren();
      frame.updateParentNodeText();

      if (
        // Already output />
        options.selfClosing.indexOf(name) !== -1 ||
        // Escaped tag, closing tag is implied
        (isImplied && !tagAllowed(name) && [ 'escape', 'recursiveEscape' ].indexOf(options.disallowedTagsMode) >= 0)
      ) {
        if (skip) {
          result = tempResult;
          tempResult = '';
        }
        return;
      }

      result += '</' + name + '>';
      if (skip) {
        result = tempResult + escapeHtml(result);
        tempResult = '';
      }
      addedText = false;
    }
  }, options.parser);
  parser.write(html);
  parser.end();

  if (options.disallowedTagsMode === 'escape' || options.disallowedTagsMode === 'recursiveEscape') {
    const lastParsedIndex = parser.endIndex;
    if (lastParsedIndex != null && lastParsedIndex >= 0 &&
        lastParsedIndex < html.length) {
      const unparsed = html.substring(lastParsedIndex);
      result += escapeHtml(unparsed);
    } else if ((lastParsedIndex == null || lastParsedIndex < 0) && html.length > 0 && result === '') {
      result = escapeHtml(html);
    }
  }

  return result;

  function initializeState() {
    result = '';
    depth = 0;
    stack = [];
    skipMap = {};
    transformMap = {};
    skipText = false;
    skipTextDepth = 0;
    rawTextEnd = null;
    skipRawText = false;
  }

  // Leave the raw text region once the parser reaches the offset where the
  // browser ends it.
  function updateRawTextRegion() {
    if (rawTextEnd !== null && parser.startIndex >= rawTextEnd) {
      rawTextEnd = null;
      skipRawText = false;
    }
  }

  // Offset of the end tag that ends a raw text element in a browser: the
  // first case-insensitive `</name` followed by HTML whitespace, `/` or `>`.
  // With no such end tag the element runs to the end of the input.
  function findRawTextEnd(tagName, from) {
    const re = new RegExp('</' + tagName + '[\\t\\n\\f\\r />]', 'ig');
    re.lastIndex = from;
    const match = re.exec(html);
    return match ? match.index : Infinity;
  }

  function escapeHtml(s, quote) {
    if (typeof (s) !== 'string') {
      s = s + '';
    }
    if (options.parser.decodeEntities) {
      s = s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
      if (quote) {
        s = s.replace(/"/g, '&quot;');
      }
    }
    // TODO: this is inadequate because it will pass `&0;`. This approach
    // will not work, each & must be considered with regard to whether it
    // is followed by a 100% syntactically valid entity or not, and escaped
    // if it is not. If this bothers you, don't set parser.decodeEntities
    // to false. (The default is true.)
    s = s.replace(/&(?![a-zA-Z0-9#]{1,20};)/g, '&amp;') // Match ampersands not part of existing HTML entity
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;');
    if (quote) {
      s = s.replace(/"/g, '&quot;');
    }
    return s;
  }

  function naughtyHref(name, href) {
    // Resolve the per-tag scheme allowlist if one is configured for
    // this tag, otherwise fall back to the global allowedSchemes.
    const allowedSchemes = has(options.allowedSchemesByTag, name)
      ? options.allowedSchemesByTag[name]
      : (options.allowedSchemes || []);
    return launderNaughtyHref(href, {
      allowedSchemes,
      allowProtocolRelative: options.allowProtocolRelative
    });
  }

  function isRefresh(attribs) {
    return Object.keys(attribs).some(function(a) {
      return a.toLowerCase() === 'http-equiv' &&
        String(attribs[a]).trim().toLowerCase() === 'refresh';
    });
  }

  // True if the `content` of a `<meta http-equiv="refresh">` must be dropped:
  // its destination URL fails the scheme policy, or it cannot be parsed as a
  // refresh at all (a browser would ignore it then, so nothing is lost).
  // Extracts the URL the way the HTML standard's "shared declarative refresh
  // steps" do, so that spelling, separator, quoting and case variations of
  // `url=`, or no `url=` at all, all yield the URL a browser would navigate to.
  function naughtyRefresh(content) {
    const input = String(content);
    const isWhitespace = function(c) {
      return c === ' ' || c === '\t' || c === '\n' || c === '\f' || c === '\r';
    };
    let position = 0;
    const skipWhitespace = function() {
      while (position < input.length && isWhitespace(input[position])) {
        position++;
      }
    };
    const lowerAt = function(i) {
      return (input[i] || '').toLowerCase();
    };
    skipWhitespace();
    const timeStart = position;
    while (position < input.length && /[0-9.]/.test(input[position])) {
      position++;
    }
    if (position === timeStart) {
      return true;
    }
    if (position < input.length) {
      const c = input[position];
      if (c !== ';' && c !== ',' && !isWhitespace(c)) {
        return true;
      }
      skipWhitespace();
      if (input[position] === ';' || input[position] === ',') {
        position++;
      }
      skipWhitespace();
    }
    if (position >= input.length) {
      // No URL: refreshes the current document
      return false;
    }
    let url = input.slice(position);
    let quoted = true;
    if (lowerAt(position) === 'u') {
      quoted = false;
      if (lowerAt(position + 1) === 'r' && lowerAt(position + 2) === 'l') {
        position += 3;
        skipWhitespace();
        if (input[position] === '=') {
          position++;
          skipWhitespace();
          quoted = true;
        }
      }
    }
    if (quoted) {
      const quote = input[position];
      if (quote === '"' || quote === '\'') {
        position++;
      }
      url = input.slice(position);
      if (quote === '"' || quote === '\'') {
        const end = url.indexOf(quote);
        if (end !== -1) {
          url = url.slice(0, end);
        }
      }
    }
    return naughtyHref('meta', url);
  }

  // True if this is an SVG SMIL animation element that animates a URL-bearing
  // attribute, e.g. `<animate attributeName="href" values="#safe;javascript:...">`.
  //
  // Such an element carries no URL of its own: the browser copies the animation
  // values into the target attribute *after* sanitization, so a `javascript:`
  // destination reaches a live link sink without ever being scheme checked.
  // `values` compounds this, because it is a semicolon-separated LIST of
  // destinations: checking it as one flat URL only validates its first entry, so
  // a leading `#safe` fragment carries the rest of the list past the policy.
  //
  // Re-checking each entry of each value attribute would leave the safety of the
  // output resting on our imitation of SMIL list parsing, so we reject the
  // animation on the strength of its target instead. Animations of attributes
  // that are not URL sinks, such as `fill` or `opacity`, are unaffected.
  function animatesUrlAttribute(name, attribs) {
    // In an XML serialization a prefixed name such as `svg:animate` is the same
    // element as `animate`, so match on the local name (GHSA-374f-7chj-9948).
    if (svgAnimationTags.indexOf(localPart(name)) === -1) {
      return false;
    }
    const schemeCheckedAttributes = options.allowedSchemesAppliedToAttributes || [];
    return Object.keys(attribs || {}).some(function(attributeName) {
      if (localPart(attributeName) !== 'attributename') {
        return false;
      }
      const target = (attribs[attributeName] || '').trim().toLowerCase();
      // The target may be namespace prefixed (`xlink:href`). Which prefixes are
      // in scope depends on the document, so consider the local name too.
      const localName = target.slice(target.lastIndexOf(':') + 1);
      return alwaysUrlAttributes.indexOf(localName) !== -1 ||
        schemeCheckedAttributes.indexOf(target) !== -1 ||
        schemeCheckedAttributes.indexOf(localName) !== -1;
    });
  }

  // Lowercased name with any namespace prefix removed.
  function localPart(name) {
    const lower = name.toLowerCase();
    return lower.slice(lower.lastIndexOf(':') + 1);
  }

  function parseUrl(value) {
    value = value.replace(/^(\w+:)?\s*[\\/]\s*[\\/]/, '$1//');
    if (value.startsWith('relative:')) {
      // An attempt to exploit our workaround for base URLs being
      // mandatory for relative URL validation in the WHATWG
      // URL parser, reject it
      throw new Error('relative: exploit attempt');
    }
    // naughtyHref is in charge of whether protocol relative URLs
    // are cool. Here we are concerned just with allowed hostnames and
    // whether to allow relative URLs.
    //
    // Build a placeholder "base URL" against which any reasonable
    // relative URL may be parsed successfully
    let base = 'relative://relative-site';
    for (let i = 0; (i < 100); i++) {
      base += `/${i}`;
    }

    const parsed = new URL(value, base);

    const isRelativeUrl = parsed && parsed.hostname === 'relative-site' && parsed.protocol === 'relative:';
    return {
      isRelativeUrl,
      url: parsed
    };
  }
  /**
   * Filters user input css properties by allowlisted regex attributes.
   * Modifies the abstractSyntaxTree object.
   *
   * @param {object} abstractSyntaxTree  - Object representation of CSS attributes.
   * @property {array[Declaration]} abstractSyntaxTree.nodes[0] -
   * Each object contains prop and value key, i.e { prop: 'color', value: 'red' }.
   * @param {object} allowedStyles       - Keys are properties (i.e color),
   * value is list of permitted regex rules (i.e /green/i).
   * @return {object}                    - The modified tree.
   */
  function filterCss(abstractSyntaxTree, allowedStyles) {
    if (!allowedStyles) {
      return abstractSyntaxTree;
    }

    const astRules = abstractSyntaxTree.nodes[0];
    let selectedRule;

    // Merge global and tag-specific styles into new AST.
    if (allowedStyles[astRules.selector] && allowedStyles['*']) {
      selectedRule = deepmerge(
        allowedStyles[astRules.selector],
        allowedStyles['*']
      );
    } else {
      selectedRule = allowedStyles[astRules.selector] || allowedStyles['*'];
    }

    if (selectedRule) {
      abstractSyntaxTree.nodes[0].nodes = astRules.nodes
        .reduce(filterDeclarations(selectedRule), []);
    }

    return abstractSyntaxTree;
  }

  /**
   * Extracts the style attributes from an AbstractSyntaxTree and formats those
   * values in the inline style attribute format.
   *
   * @param  {AbstractSyntaxTree} filteredAST
   * @return {string}             - Example:
   * "color:yellow;text-align:center !important;font-family:helvetica;"
   */
  function stringifyStyleAttributes(filteredAST) {
    return filteredAST.nodes[0].nodes
      .reduce(function(extractedAttributes, attrObject) {
        extractedAttributes.push(
          `${attrObject.prop}:${attrObject.value}${attrObject.important ? ' !important' : ''}`
        );
        return extractedAttributes;
      }, [])
      .join(';');
  }

  /**
    * Filters the existing attributes for the given property. Discards any attributes
    * which don't match the allowlist.
    *
    * @param  {object} selectedRule - Example: { color: red, font-family: helvetica }
    * @param  {array} allowedDeclarationsList - List of declarations
    * which pass the allowlist.
    * @param  {object} attributeObject - Object representing the current css property.
    * @property {string} attributeObject.type - Typically 'declaration'.
    * @property {string} attributeObject.prop - The CSS property, i.e 'color'.
    * @property {string} attributeObject.value - The corresponding value to
    * the css property, i.e 'red'.
    * @return {function} - When used in Array.reduce,
    * will return an array of Declaration objects
    */
  function filterDeclarations(selectedRule) {
    return function (allowedDeclarationsList, attributeObject) {
      // If this property is allowlisted...
      if (has(selectedRule, attributeObject.prop)) {
        const matchesRegex = selectedRule[attributeObject.prop]
          .some(function(regularExpression) {
            return regularExpression.test(attributeObject.value);
          });

        if (matchesRegex) {
          allowedDeclarationsList.push(attributeObject);
        }
      }
      return allowedDeclarationsList;
    };
  }

  function filterClasses(classes, allowed, allowedGlobs) {
    if (!allowed) {
      // The class attribute is allowed without filtering on this tag
      return classes;
    }
    classes = classes.split(/\s+/);
    return classes.filter(function(clss) {
      return allowed.indexOf(clss) !== -1 || allowedGlobs.some(function(glob) {
        return glob.test(clss);
      });
    }).join(' ');
  }
}

// Defaults are accessible to you so that you can use them as a starting point
// programmatically if you wish

const htmlParserDefaults = {
  decodeEntities: true
};
sanitizeHtml.defaults = {
  allowedTags: [
    // Sections derived from MDN element categories and limited to the more
    // benign categories.
    // https://developer.mozilla.org/en-US/docs/Web/HTML/Element
    // Content sectioning
    'address', 'article', 'aside', 'footer', 'header',
    'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'hgroup',
    'main', 'nav', 'section',
    // Text content
    'blockquote', 'dd', 'div', 'dl', 'dt', 'figcaption', 'figure',
    'hr', 'li', 'menu', 'ol', 'p', 'pre', 'ul',
    // Inline text semantics
    'a', 'abbr', 'b', 'bdi', 'bdo', 'br', 'cite', 'code', 'data', 'dfn',
    'em', 'i', 'kbd', 'mark', 'q',
    'rb', 'rp', 'rt', 'rtc', 'ruby',
    's', 'samp', 'small', 'span', 'strong', 'sub', 'sup', 'time', 'u', 'var', 'wbr',
    // Table content
    'caption', 'col', 'colgroup', 'table', 'tbody', 'td', 'tfoot', 'th',
    'thead', 'tr'
  ],
  // Tags that cannot be boolean
  nonBooleanAttributes: [
    'abbr', 'accept', 'accept-charset', 'accesskey', 'action',
    'allow', 'alt', 'as', 'autocapitalize', 'autocomplete',
    'blocking', 'charset', 'cite', 'class', 'color', 'cols',
    'colspan', 'content', 'contenteditable', 'coords', 'crossorigin',
    'data', 'datetime', 'decoding', 'dir', 'dirname', 'download',
    'draggable', 'enctype', 'enterkeyhint', 'fetchpriority', 'for',
    'form', 'formaction', 'formenctype', 'formmethod', 'formtarget',
    'headers', 'height', 'hidden', 'high', 'href', 'hreflang',
    'http-equiv', 'id', 'imagesizes', 'imagesrcset', 'inputmode',
    'integrity', 'is', 'itemid', 'itemprop', 'itemref', 'itemtype',
    'kind', 'label', 'lang', 'list', 'loading', 'low', 'max',
    'maxlength', 'media', 'method', 'min', 'minlength', 'name',
    'nonce', 'optimum', 'pattern', 'ping', 'placeholder', 'popover',
    'popovertarget', 'popovertargetaction', 'poster', 'preload',
    'referrerpolicy', 'rel', 'rows', 'rowspan', 'sandbox', 'scope',
    'shape', 'size', 'sizes', 'slot', 'span', 'spellcheck', 'src',
    'srcdoc', 'srclang', 'srcset', 'start', 'step', 'style',
    'tabindex', 'target', 'title', 'translate', 'type', 'usemap',
    'value', 'width', 'wrap',
    // Event handlers
    'onauxclick', 'onafterprint', 'onbeforematch', 'onbeforeprint',
    'onbeforeunload', 'onbeforetoggle', 'onblur', 'oncancel',
    'oncanplay', 'oncanplaythrough', 'onchange', 'onclick', 'onclose',
    'oncontextlost', 'oncontextmenu', 'oncontextrestored', 'oncopy',
    'oncuechange', 'oncut', 'ondblclick', 'ondrag', 'ondragend',
    'ondragenter', 'ondragleave', 'ondragover', 'ondragstart',
    'ondrop', 'ondurationchange', 'onemptied', 'onended',
    'onerror', 'onfocus', 'onformdata', 'onhashchange', 'oninput',
    'oninvalid', 'onkeydown', 'onkeypress', 'onkeyup',
    'onlanguagechange', 'onload', 'onloadeddata', 'onloadedmetadata',
    'onloadstart', 'onmessage', 'onmessageerror', 'onmousedown',
    'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout',
    'onmouseover', 'onmouseup', 'onoffline', 'ononline', 'onpagehide',
    'onpageshow', 'onpaste', 'onpause', 'onplay', 'onplaying',
    'onpopstate', 'onprogress', 'onratechange', 'onreset', 'onresize',
    'onrejectionhandled', 'onscroll', 'onscrollend',
    'onsecuritypolicyviolation', 'onseeked', 'onseeking', 'onselect',
    'onslotchange', 'onstalled', 'onstorage', 'onsubmit', 'onsuspend',
    'ontimeupdate', 'ontoggle', 'onunhandledrejection', 'onunload',
    'onvolumechange', 'onwaiting', 'onwheel'
  ],
  disallowedTagsMode: 'discard',
  allowedAttributes: {
    a: [ 'href', 'name', 'target' ],
    // We don't currently allow img itself by default, but
    // these attributes would make sense if we did.
    img: [ 'src', 'srcset', 'alt', 'title', 'width', 'height', 'loading' ]
  },
  allowedEmptyAttributes: [
    'alt'
  ],
  // Lots of these won't come up by default because we don't allow them
  selfClosing: [ 'img', 'br', 'hr', 'area', 'base', 'basefont', 'input', 'link', 'meta', 'col' ],
  // URL schemes we permit
  allowedSchemes: [ 'http', 'https', 'ftp', 'mailto', 'tel' ],
  allowedSchemesByTag: {},
  allowedSchemesAppliedToAttributes: [
    'href', 'src', 'cite',
    'action', 'formaction', 'data', 'xlink:href',
    'poster', 'background', 'ping',
    'longdesc', 'usemap', 'codebase', 'classid', 'archive',
    'profile', 'manifest', 'itemid',
    'dynsrc', 'lowsrc'
  ],
  allowProtocolRelative: true,
  enforceHtmlBoundary: false,
  parseStyleAttributes: true,
  preserveEscapedAttributes: false
};

sanitizeHtml.simpleTransform = function(newTagName, newAttribs, merge) {
  merge = (merge === undefined) ? true : merge;
  newAttribs = newAttribs || {};

  return function(tagName, attribs) {
    let attrib;
    if (merge) {
      for (attrib in newAttribs) {
        attribs[attrib] = newAttribs[attrib];
      }
    } else {
      attribs = newAttribs;
    }

    return {
      tagName: newTagName,
      attribs
    };
  };
};


/***/ },

/***/ "?fe98"
/*!**************************************!*\
  !*** ./terminal-highlight (ignored) ***!
  \**************************************/
() {

/* (ignored) */

/***/ },

/***/ "?2f81"
/*!********************!*\
  !*** fs (ignored) ***!
  \********************/
() {

/* (ignored) */

/***/ },

/***/ "?25fb"
/*!**********************!*\
  !*** path (ignored) ***!
  \**********************/
() {

/* (ignored) */

/***/ },

/***/ "?6f78"
/*!*******************************!*\
  !*** source-map-js (ignored) ***!
  \*******************************/
() {

/* (ignored) */

/***/ },

/***/ "?9214"
/*!*********************!*\
  !*** url (ignored) ***!
  \*********************/
() {

/* (ignored) */

/***/ },

/***/ "./node_modules/nanoid/non-secure/index.cjs"
/*!**************************************************!*\
  !*** ./node_modules/nanoid/non-secure/index.cjs ***!
  \**************************************************/
(module) {

let urlAlphabet =
  'useandom-26T198340PX75pxJACKVERYMINDBUSHWOLF_GQZbfghjklqvwyzrict'

let customAlphabet = (alphabet, defaultSize = 21) => {
  return (size = defaultSize) => {
    let id = ''
    let i = size | 0
    while (i-- > 0) {
      id += alphabet[(Math.random() * alphabet.length) | 0]
    }
    return id
  }
}

let nanoid = (size = 21) => {
  let id = ''
  let i = size | 0
  while (i-- > 0) {
    id += urlAlphabet[(Math.random() * 64) | 0]
  }
  return id
}

module.exports = { nanoid, customAlphabet }


/***/ },

/***/ "./node_modules/sanitize-html/node_modules/dom-serializer/dist/foreign-names.js"
/*!**************************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/dom-serializer/dist/foreign-names.js ***!
  \**************************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   attributeNames: () => (/* binding */ attributeNames),
/* harmony export */   elementNames: () => (/* binding */ elementNames)
/* harmony export */ });
/**
 * Mixed-case SVG and MathML element names recognized in foreign content.
 * @see https://html.spec.whatwg.org/multipage/parsing.html#parsing-main-inforeign
 */
const elementNames = new Map("altGlyph altGlyphDef altGlyphItem animateColor animateMotion animateTransform clipPath feBlend feColorMatrix feComponentTransfer feComposite feConvolveMatrix feDiffuseLighting feDisplacementMap feDistantLight feDropShadow feFlood feFuncA feFuncB feFuncG feFuncR feGaussianBlur feImage feMerge feMergeNode feMorphology feOffset fePointLight feSpecularLighting feSpotLight feTile feTurbulence foreignObject glyphRef linearGradient radialGradient textPath"
    .split(" ")
    .map((name) => [name.toLowerCase(), name]));
/**
 * Mixed-case SVG and MathML attribute names recognized in foreign content.
 * @see https://html.spec.whatwg.org/multipage/parsing.html#parsing-main-inforeign
 */
const attributeNames = new Map("definitionURL attributeName attributeType baseFrequency baseProfile calcMode clipPathUnits diffuseConstant edgeMode filterUnits glyphRef gradientTransform gradientUnits kernelMatrix kernelUnitLength keyPoints keySplines keyTimes lengthAdjust limitingConeAngle markerHeight markerUnits markerWidth maskContentUnits maskUnits numOctaves pathLength patternContentUnits patternTransform patternUnits pointsAtX pointsAtY pointsAtZ preserveAlpha preserveAspectRatio primitiveUnits refX refY repeatCount repeatDur requiredExtensions requiredFeatures specularConstant specularExponent spreadMethod startOffset stdDeviation stitchTiles surfaceScale systemLanguage tableValues targetX targetY textLength viewBox viewTarget xChannelSelector yChannelSelector zoomAndPan"
    .split(" ")
    .map((name) => [name.toLowerCase(), name]));
//# sourceMappingURL=foreign-names.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/dom-serializer/dist/index.js"
/*!******************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/dom-serializer/dist/index.js ***!
  \******************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var domelementtype__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! domelementtype */ "./node_modules/sanitize-html/node_modules/domelementtype/dist/index.js");
/* harmony import */ var entities__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! entities */ "./node_modules/sanitize-html/node_modules/entities/dist/escape.js");
/* harmony import */ var _foreign_names_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./foreign-names.js */ "./node_modules/sanitize-html/node_modules/dom-serializer/dist/foreign-names.js");



// ── Constants ────────────────────────────────────────────────────────
/** Elements whose text content is never entity-encoded. */
const unencodedElements = new Set("style script xmp iframe noembed noframes plaintext noscript".split(" "));
/** HTML void elements — they cannot have children. */
const voidElements = new Set("area base basefont br col command embed frame hr img input isindex keygen link meta param source track wbr".split(" "));
/** Elements that switch the parser into foreign (XML-like) mode. */
const foreignElements = new Set(["svg", "math"]);
/**
 * Foreign-mode integration points: children of these elements are parsed
 * as HTML again, not as foreign content.
 */
const foreignModeIntegrationPoints = new Set("mi mo mn ms mtext annotation-xml foreignObject desc title".split(" "));
// ── Public API ───────────────────────────────────────────────────────
/**
 * Renders a DOM node or an array of DOM nodes to a string.
 *
 * Can be thought of as the equivalent of the `outerHTML` of the passed
 * node(s).
 * @param node Node to be rendered.
 * @param options Changes serialization behavior
 */
function render(node, options = {}) {
    const nodes = "length" in node ? node : [node];
    /*
     * `xmlMode` is threaded as a separate argument through the internal
     * functions so that foreign-mode transitions (svg/mathml ↔ html) can
     * adjust it without copying the options object on every element.
     */
    const xmlMode = options.xmlMode ?? false;
    let output = "";
    // eslint-disable-next-line unicorn/no-for-loop
    for (let index = 0; index < nodes.length; index++) {
        output += renderNode(nodes[index], options, xmlMode);
    }
    return output;
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (render);
// ── Internal rendering ───────────────────────────────────────────────
/**
 * Render an array of child nodes (skips the single-node wrapping in `render`).
 * @param children The child nodes to render.
 * @param options The serialization options.
 * @param xmlMode The XML mode to use.
 */
function renderChildren(children, options, xmlMode) {
    let output = "";
    // eslint-disable-next-line unicorn/no-for-loop
    for (let index = 0; index < children.length; index++) {
        output += renderNode(children[index], options, xmlMode);
    }
    return output;
}
function renderNode(node, options, xmlMode) {
    switch (node.type) {
        case domelementtype__WEBPACK_IMPORTED_MODULE_0__.Root: {
            return renderChildren(node.children, options, xmlMode);
        }
        case domelementtype__WEBPACK_IMPORTED_MODULE_0__.Directive: {
            return `<${node.data}>`;
        }
        case domelementtype__WEBPACK_IMPORTED_MODULE_0__.Comment: {
            return `<!--${node.data}-->`;
        }
        case domelementtype__WEBPACK_IMPORTED_MODULE_0__.CDATA: {
            return `<![CDATA[${node.children[0].data}]]>`;
        }
        case domelementtype__WEBPACK_IMPORTED_MODULE_0__.Script:
        case domelementtype__WEBPACK_IMPORTED_MODULE_0__.Style:
        case domelementtype__WEBPACK_IMPORTED_MODULE_0__.Tag: {
            return renderTag(node, options, xmlMode);
        }
        case domelementtype__WEBPACK_IMPORTED_MODULE_0__.Text: {
            const element = node;
            const data = element.data || "";
            /*
             * Skip encoding when entities weren't decoded on input, or when
             * inside a raw-text element (script, style, etc.) in HTML mode.
             */
            if ((options.encodeEntities ?? options.decodeEntities) !== false &&
                !(!xmlMode &&
                    element.parent &&
                    unencodedElements.has(element.parent.name))) {
                // `xmlMode: "foreign"` is truthy
                return xmlMode || options.encodeEntities !== "utf8"
                    ? (0,entities__WEBPACK_IMPORTED_MODULE_1__.encodeXML)(data)
                    : (0,entities__WEBPACK_IMPORTED_MODULE_1__.escapeText)(data);
            }
            return data;
        }
    }
}
function renderTag(element, options, xmlMode) {
    if (xmlMode === "foreign") {
        // Correct lowercase element names back to their canonical mixed-case form
        element.name = _foreign_names_js__WEBPACK_IMPORTED_MODULE_2__.elementNames.get(element.name) ?? element.name;
        // Integration points exit foreign mode: their children are HTML
        if (element.parent &&
            foreignModeIntegrationPoints.has(element.parent.name)) {
            xmlMode = false;
        }
    }
    if (!xmlMode && foreignElements.has(element.name)) {
        xmlMode = "foreign";
    }
    const { name, children } = element;
    // Cache the void-element check — used for both self-closing and closing-tag logic
    const isVoid = !xmlMode && voidElements.has(name);
    let tag = `<${name}${formatAttributes(element.attribs, options, xmlMode)}`;
    if (children.length === 0 &&
        (xmlMode
            ? options.selfClosingTags !== false
            : options.selfClosingTags && isVoid)) {
        // XML: `<br/>`, HTML: `<br />`
        tag += xmlMode ? "/>" : " />";
    }
    else {
        tag += ">";
        if (children.length > 0) {
            tag += renderChildren(children, options, xmlMode);
        }
        if (!isVoid) {
            tag += `</${name}>`;
        }
    }
    return tag;
}
// ── Attribute formatting ─────────────────────────────────────────────
function replaceQuotes(value) {
    return value.replaceAll('"', "&quot;");
}
/**
 * Serialize an element's attribute map to a string.
 *
 * Returns a string with a leading space before each attribute, or an
 * empty string if there are no attributes. This convention lets the
 * caller unconditionally concatenate the result onto the tag name.
 * @param attributes
 * @param options
 * @param xmlMode
 */
function formatAttributes(attributes, options, xmlMode) {
    if (!attributes)
        return "";
    /*
     * Pick the right encoder:
     *  - Encoding disabled → only escape double-quotes (for valid attributes)
     *  - XML / non-utf8    → full numeric entity encoding (encodeXML)
     *  - HTML + utf8       → minimal escaping (escapeAttribute)
     */
    const encode = (options.encodeEntities ?? options.decodeEntities) === false
        ? replaceQuotes
        : xmlMode || options.encodeEntities !== "utf8"
            ? entities__WEBPACK_IMPORTED_MODULE_1__.encodeXML
            : entities__WEBPACK_IMPORTED_MODULE_1__.escapeAttribute;
    const isForeign = xmlMode === "foreign";
    const showEmpty = !!(options.emptyAttrs ?? xmlMode);
    let result = "";
    for (const key in attributes) {
        if (!Object.hasOwn(attributes, key))
            continue;
        const value = attributes[key];
        const k = isForeign ? (_foreign_names_js__WEBPACK_IMPORTED_MODULE_2__.attributeNames.get(key) ?? key) : key;
        result +=
            !showEmpty && (value == null || value === "")
                ? ` ${k}`
                : ` ${k}="${encode(value == null ? "" : String(value))}"`;
    }
    return result;
}
//# sourceMappingURL=index.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domelementtype/dist/index.js"
/*!******************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domelementtype/dist/index.js ***!
  \******************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   CDATA: () => (/* binding */ CDATA),
/* harmony export */   Comment: () => (/* binding */ Comment),
/* harmony export */   Directive: () => (/* binding */ Directive),
/* harmony export */   Doctype: () => (/* binding */ Doctype),
/* harmony export */   ElementType: () => (/* binding */ ElementType),
/* harmony export */   Root: () => (/* binding */ Root),
/* harmony export */   Script: () => (/* binding */ Script),
/* harmony export */   Style: () => (/* binding */ Style),
/* harmony export */   Tag: () => (/* binding */ Tag),
/* harmony export */   Text: () => (/* binding */ Text),
/* harmony export */   isTag: () => (/* binding */ isTag)
/* harmony export */ });
/** Types of elements found in htmlparser2's DOM */
var ElementType;
(function (ElementType) {
    /** Type for the root element of a document */
    ElementType["Root"] = "root";
    /** Type for Text */
    ElementType["Text"] = "text";
    /** Type for <? ... ?> */
    ElementType["Directive"] = "directive";
    /** Type for <!-- ... --> */
    ElementType["Comment"] = "comment";
    /** Type for <script> tags */
    ElementType["Script"] = "script";
    /** Type for <style> tags */
    ElementType["Style"] = "style";
    /** Type for Any tag */
    ElementType["Tag"] = "tag";
    /** Type for <![CDATA[ ... ]]> */
    ElementType["CDATA"] = "cdata";
    /** Type for <!doctype ...> */
    ElementType["Doctype"] = "doctype";
})(ElementType || (ElementType = {}));
/**
 * Tests whether an element is a tag or not.
 * @param element Element to test
 * @param element.type Node type discriminator to check.
 */
function isTag(element) {
    return (element.type === ElementType.Tag ||
        element.type === ElementType.Script ||
        element.type === ElementType.Style);
}
// Exports for backwards compatibility
/** Type for the root element of a document */
// eslint-disable-next-line prefer-destructuring
const Root = ElementType.Root;
/** Type for Text */
// eslint-disable-next-line prefer-destructuring
const Text = ElementType.Text;
/** Type for <? ... ?> */
// eslint-disable-next-line prefer-destructuring
const Directive = ElementType.Directive;
/** Type for <!-- ... --> */
// eslint-disable-next-line prefer-destructuring
const Comment = ElementType.Comment;
/** Type for <script> tags */
// eslint-disable-next-line prefer-destructuring
const Script = ElementType.Script;
/** Type for <style> tags */
// eslint-disable-next-line prefer-destructuring
const Style = ElementType.Style;
/** Type for Any tag */
// eslint-disable-next-line prefer-destructuring
const Tag = ElementType.Tag;
/** Type for <![CDATA[ ... ]]> */
// eslint-disable-next-line prefer-destructuring
const CDATA = ElementType.CDATA;
/** Type for <!doctype ...> */
// eslint-disable-next-line prefer-destructuring
const Doctype = ElementType.Doctype;


/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domhandler/dist/index.js"
/*!**************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domhandler/dist/index.js ***!
  \**************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   CDATA: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.CDATA),
/* harmony export */   Comment: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.Comment),
/* harmony export */   DataNode: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.DataNode),
/* harmony export */   Document: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.Document),
/* harmony export */   DomHandler: () => (/* binding */ DomHandler),
/* harmony export */   Element: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.Element),
/* harmony export */   Node: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.Node),
/* harmony export */   NodeWithChildren: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.NodeWithChildren),
/* harmony export */   ProcessingInstruction: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.ProcessingInstruction),
/* harmony export */   Text: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.Text),
/* harmony export */   cloneNode: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.cloneNode),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   hasChildren: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.hasChildren),
/* harmony export */   isCDATA: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.isCDATA),
/* harmony export */   isComment: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.isComment),
/* harmony export */   isDirective: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.isDirective),
/* harmony export */   isDocument: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.isDocument),
/* harmony export */   isTag: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.isTag),
/* harmony export */   isText: () => (/* reexport safe */ _node_js__WEBPACK_IMPORTED_MODULE_1__.isText)
/* harmony export */ });
/* harmony import */ var domelementtype__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! domelementtype */ "./node_modules/sanitize-html/node_modules/domelementtype/dist/index.js");
/* harmony import */ var _node_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./node.js */ "./node_modules/sanitize-html/node_modules/domhandler/dist/node.js");



// Default options
const defaultOptions = {
    withStartIndices: false,
    withEndIndices: false,
    xmlMode: false,
};
/**
 * Event-based handler that builds a DOM tree from parser callbacks.
 */
class DomHandler {
    /** The elements of the DOM */
    dom = [];
    /** The root element for the DOM */
    root = new _node_js__WEBPACK_IMPORTED_MODULE_1__.Document(this.dom);
    /** Called once parsing has completed. */
    callback;
    /** Settings for the handler. */
    options;
    /** Callback whenever a tag is closed. */
    elementCB;
    /** Indicated whether parsing has been completed. */
    done = false;
    /** Stack of open tags. */
    tagStack = [this.root];
    /** A data node that is still being written to. */
    lastNode = null;
    /** Reference to the parser instance. Used for location information. */
    parser = null;
    /**
     * @param callback Called once parsing has completed.
     * @param options Settings for the handler.
     * @param elementCB Callback whenever a tag is closed.
     */
    constructor(callback, options, elementCB) {
        // Make it possible to skip arguments, for backwards-compatibility
        if (typeof options === "function") {
            elementCB = options;
            options = defaultOptions;
        }
        if (typeof callback === "object") {
            options = callback;
            callback = undefined;
        }
        this.callback = callback ?? null;
        this.options = options ?? defaultOptions;
        this.elementCB = elementCB ?? null;
    }
    onparserinit(parser) {
        this.parser = parser;
    }
    // Resets the handler back to starting state
    onreset() {
        this.dom = [];
        this.root = new _node_js__WEBPACK_IMPORTED_MODULE_1__.Document(this.dom);
        this.done = false;
        this.tagStack = [this.root];
        this.lastNode = null;
        this.parser = null;
    }
    // Signals the handler that parsing is done
    onend() {
        if (this.done)
            return;
        this.done = true;
        this.parser = null;
        this.handleCallback(null);
    }
    onerror(error) {
        this.handleCallback(error);
    }
    onclosetag() {
        this.lastNode = null;
        const element = this.tagStack.pop();
        if (this.options.withEndIndices && this.parser) {
            element.endIndex = this.parser.endIndex;
        }
        if (this.elementCB)
            this.elementCB(element);
    }
    onopentag(name, attribs) {
        const type = this.options.xmlMode ? domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Tag : undefined;
        const element = new _node_js__WEBPACK_IMPORTED_MODULE_1__.Element(name, attribs, undefined, type);
        this.addNode(element);
        this.tagStack.push(element);
    }
    ontext(data) {
        const { lastNode } = this;
        if (lastNode && lastNode.type === domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Text) {
            lastNode.data += data;
            if (this.options.withEndIndices && this.parser) {
                lastNode.endIndex = this.parser.endIndex;
            }
        }
        else {
            const node = new _node_js__WEBPACK_IMPORTED_MODULE_1__.Text(data);
            this.addNode(node);
            this.lastNode = node;
        }
    }
    oncomment(data) {
        if (this.lastNode && this.lastNode.type === domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Comment) {
            this.lastNode.data += data;
            return;
        }
        const node = new _node_js__WEBPACK_IMPORTED_MODULE_1__.Comment(data);
        this.addNode(node);
        this.lastNode = node;
    }
    oncommentend() {
        this.lastNode = null;
    }
    oncdatastart() {
        const text = new _node_js__WEBPACK_IMPORTED_MODULE_1__.Text("");
        const node = new _node_js__WEBPACK_IMPORTED_MODULE_1__.CDATA([text]);
        this.addNode(node);
        text.parent = node;
        this.lastNode = text;
    }
    oncdataend() {
        this.lastNode = null;
    }
    onprocessinginstruction(name, data) {
        const node = new _node_js__WEBPACK_IMPORTED_MODULE_1__.ProcessingInstruction(name, data);
        this.addNode(node);
    }
    handleCallback(error) {
        if (typeof this.callback === "function") {
            this.callback(error, this.dom);
        }
        else if (error) {
            throw error;
        }
    }
    addNode(node) {
        const parent = this.tagStack[this.tagStack.length - 1];
        const previousSibling = parent.children[parent.children.length - 1];
        if (this.options.withStartIndices && this.parser) {
            node.startIndex = this.parser.startIndex;
        }
        if (this.options.withEndIndices && this.parser) {
            node.endIndex = this.parser.endIndex;
        }
        parent.children.push(node);
        if (previousSibling) {
            node.prev = previousSibling;
            previousSibling.next = node;
        }
        node.parent = parent;
        this.lastNode = null;
    }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (DomHandler);


/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domhandler/dist/node.js"
/*!*************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domhandler/dist/node.js ***!
  \*************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   CDATA: () => (/* binding */ CDATA),
/* harmony export */   Comment: () => (/* binding */ Comment),
/* harmony export */   DataNode: () => (/* binding */ DataNode),
/* harmony export */   Document: () => (/* binding */ Document),
/* harmony export */   Element: () => (/* binding */ Element),
/* harmony export */   Node: () => (/* binding */ Node),
/* harmony export */   NodeWithChildren: () => (/* binding */ NodeWithChildren),
/* harmony export */   ProcessingInstruction: () => (/* binding */ ProcessingInstruction),
/* harmony export */   Text: () => (/* binding */ Text),
/* harmony export */   cloneNode: () => (/* binding */ cloneNode),
/* harmony export */   hasChildren: () => (/* binding */ hasChildren),
/* harmony export */   isCDATA: () => (/* binding */ isCDATA),
/* harmony export */   isComment: () => (/* binding */ isComment),
/* harmony export */   isDirective: () => (/* binding */ isDirective),
/* harmony export */   isDocument: () => (/* binding */ isDocument),
/* harmony export */   isTag: () => (/* binding */ isTag),
/* harmony export */   isText: () => (/* binding */ isText)
/* harmony export */ });
/* harmony import */ var domelementtype__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! domelementtype */ "./node_modules/sanitize-html/node_modules/domelementtype/dist/index.js");

/**
 * This object will be used as the prototype for Nodes when creating a
 * DOM-Level-1-compliant structure.
 */
class Node {
    /** Parent of the node */
    parent = null;
    /** Previous sibling */
    prev = null;
    /** Next sibling */
    next = null;
    /** The start index of the node. Requires `withStartIndices` on the handler to be `true. */
    startIndex = null;
    /** The end index of the node. Requires `withEndIndices` on the handler to be `true. */
    endIndex = null;
    // Read-write aliases for properties
    /**
     * Same as {@link parent}.
     * [DOM spec](https://dom.spec.whatwg.org)-compatible alias.
     */
    get parentNode() {
        return this.parent;
    }
    set parentNode(parent) {
        this.parent = parent;
    }
    /**
     * Same as {@link prev}.
     * [DOM spec](https://dom.spec.whatwg.org)-compatible alias.
     */
    get previousSibling() {
        return this.prev;
    }
    set previousSibling(previous) {
        this.prev = previous;
    }
    /**
     * Same as {@link next}.
     * [DOM spec](https://dom.spec.whatwg.org)-compatible alias.
     */
    get nextSibling() {
        return this.next;
    }
    set nextSibling(next) {
        this.next = next;
    }
    /**
     * Clone this node, and optionally its children.
     * @param recursive Clone child nodes as well.
     * @returns A clone of the node.
     */
    cloneNode(recursive = false) {
        return cloneNode(this, recursive);
    }
}
/**
 * A node that contains some data.
 */
class DataNode extends Node {
    data;
    /**
     * @param data The content of the data node
     */
    constructor(data) {
        super();
        this.data = data;
    }
    /**
     * Same as {@link data}.
     * [DOM spec](https://dom.spec.whatwg.org)-compatible alias.
     */
    get nodeValue() {
        return this.data;
    }
    set nodeValue(data) {
        this.data = data;
    }
}
/**
 * Text within the document.
 */
class Text extends DataNode {
    type = domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Text;
    get nodeType() {
        return 3;
    }
}
/**
 * Comments within the document.
 */
class Comment extends DataNode {
    type = domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Comment;
    get nodeType() {
        return 8;
    }
}
/**
 * Processing instructions, including doc types.
 */
class ProcessingInstruction extends DataNode {
    type = domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Directive;
    name;
    constructor(name, data) {
        super(data);
        this.name = name;
    }
    get nodeType() {
        return 1;
    }
    /** If this is a doctype, the document type name (parse5 only). */
    "x-name";
    /** If this is a doctype, the document type public identifier (parse5 only). */
    "x-publicId";
    /** If this is a doctype, the document type system identifier (parse5 only). */
    "x-systemId";
}
/**
 * A node that can have children.
 */
class NodeWithChildren extends Node {
    children;
    /**
     * @param children Children of the node. Only certain node types can have children.
     */
    constructor(children) {
        super();
        this.children = children;
    }
    // Aliases
    /** First child of the node. */
    get firstChild() {
        return this.children[0] ?? null;
    }
    /** Last child of the node. */
    get lastChild() {
        return this.children.length > 0
            ? this.children[this.children.length - 1]
            : null;
    }
    /**
     * Same as {@link children}.
     * [DOM spec](https://dom.spec.whatwg.org)-compatible alias.
     */
    get childNodes() {
        return this.children;
    }
    set childNodes(children) {
        this.children = children;
    }
}
/**
 * CDATA nodes.
 */
class CDATA extends NodeWithChildren {
    type = domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.CDATA;
    get nodeType() {
        return 4;
    }
}
/**
 * The root node of the document.
 */
class Document extends NodeWithChildren {
    type = domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Root;
    get nodeType() {
        return 9;
    }
}
/**
 * An element within the DOM.
 */
class Element extends NodeWithChildren {
    name;
    attribs;
    type;
    /**
     * @param name Name of the tag, eg. `div`, `span`.
     * @param attribs Object mapping attribute names to attribute values.
     * @param children Children of the node.
     * @param type Node type used for the new node instance.
     */
    constructor(name, attribs, children = [], type = name === "script"
        ? domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Script
        : name === "style"
            ? domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Style
            : domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Tag) {
        super(children);
        this.name = name;
        this.attribs = attribs;
        this.type = type;
    }
    get nodeType() {
        return 1;
    }
    // DOM Level 1 aliases
    /**
     * Same as {@link name}.
     * [DOM spec](https://dom.spec.whatwg.org)-compatible alias.
     */
    get tagName() {
        return this.name;
    }
    set tagName(name) {
        this.name = name;
    }
    get attributes() {
        return Object.keys(this.attribs).map((name) => ({
            name,
            value: this.attribs[name],
            namespace: this["x-attribsNamespace"]?.[name],
            prefix: this["x-attribsPrefix"]?.[name],
        }));
    }
    /** Element namespace (parse5 only). */
    namespace;
    /** Element attribute namespaces (parse5 only). */
    "x-attribsNamespace";
    /** Element attribute namespace-related prefixes (parse5 only). */
    "x-attribsPrefix";
}
/**
 * Checks if `node` is an element node.
 * @param node Node to check.
 * @returns `true` if the node is an element node.
 */
function isTag(node) {
    return (0,domelementtype__WEBPACK_IMPORTED_MODULE_0__.isTag)(node);
}
/**
 * Checks if `node` is a CDATA node.
 * @param node Node to check.
 * @returns `true` if the node is a CDATA node.
 */
function isCDATA(node) {
    return node.type === domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.CDATA;
}
/**
 * Checks if `node` is a text node.
 * @param node Node to check.
 * @returns `true` if the node is a text node.
 */
function isText(node) {
    return node.type === domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Text;
}
/**
 * Checks if `node` is a comment node.
 * @param node Node to check.
 * @returns `true` if the node is a comment node.
 */
function isComment(node) {
    return node.type === domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Comment;
}
/**
 * Checks if `node` is a directive node.
 * @param node Node to check.
 * @returns `true` if the node is a directive node.
 */
function isDirective(node) {
    return node.type === domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Directive;
}
/**
 * Checks if `node` is a document node.
 * @param node Node to check.
 * @returns `true` if the node is a document node.
 */
function isDocument(node) {
    return node.type === domelementtype__WEBPACK_IMPORTED_MODULE_0__.ElementType.Root;
}
/**
 * Checks if `node` has children.
 * @param node Node to check.
 * @returns `true` if the node has children.
 */
function hasChildren(node) {
    return Object.hasOwn(node, "children");
}
/**
 * Clone a node, and optionally its children.
 * @param node Node to clone.
 * @param recursive Clone child nodes as well.
 * @returns A clone of the node.
 */
function cloneNode(node, recursive = false) {
    let result;
    if (isText(node)) {
        result = new Text(node.data);
    }
    else if (isComment(node)) {
        result = new Comment(node.data);
    }
    else if (isTag(node)) {
        const children = recursive ? cloneChildren(node.children) : [];
        const clone = new Element(node.name, { ...node.attribs }, children);
        for (const child of children) {
            child.parent = clone;
        }
        if (node.namespace != null) {
            clone.namespace = node.namespace;
        }
        if (node["x-attribsNamespace"]) {
            clone["x-attribsNamespace"] = { ...node["x-attribsNamespace"] };
        }
        if (node["x-attribsPrefix"]) {
            clone["x-attribsPrefix"] = { ...node["x-attribsPrefix"] };
        }
        result = clone;
    }
    else if (isCDATA(node)) {
        const children = recursive ? cloneChildren(node.children) : [];
        const clone = new CDATA(children);
        for (const child of children) {
            child.parent = clone;
        }
        result = clone;
    }
    else if (isDocument(node)) {
        const children = recursive ? cloneChildren(node.children) : [];
        const clone = new Document(children);
        for (const child of children) {
            child.parent = clone;
        }
        if (node["x-mode"]) {
            clone["x-mode"] = node["x-mode"];
        }
        result = clone;
    }
    else if (isDirective(node)) {
        const instruction = new ProcessingInstruction(node.name, node.data);
        if (node["x-name"] != null) {
            instruction["x-name"] = node["x-name"];
            instruction["x-publicId"] = node["x-publicId"];
            instruction["x-systemId"] = node["x-systemId"];
        }
        result = instruction;
    }
    else {
        throw new Error(`Not implemented yet: ${node.type}`);
    }
    result.startIndex = node.startIndex;
    result.endIndex = node.endIndex;
    if (node.sourceCodeLocation != null) {
        result.sourceCodeLocation = node.sourceCodeLocation;
    }
    return result;
}
/**
 * Clone a list of child nodes.
 * @param childs The child nodes to clone.
 * @returns A list of cloned child nodes.
 */
function cloneChildren(childs) {
    const children = childs.map((child) => cloneNode(child, true));
    for (let index = 1; index < children.length; index++) {
        children[index].prev = children[index - 1];
        children[index - 1].next = children[index];
    }
    return children;
}


/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domutils/dist/feeds.js"
/*!************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domutils/dist/feeds.js ***!
  \************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getFeed: () => (/* binding */ getFeed)
/* harmony export */ });
/* harmony import */ var _legacy_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./legacy.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/legacy.js");
/* harmony import */ var _stringify_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./stringify.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/stringify.js");


/**
 * Get the feed object from the root of a DOM tree.
 *
 * @category Feeds
 * @param document The DOM to extract the feed from.
 * @returns The feed.
 */
function getFeed(document) {
    const feedRoot = getOneElement(isValidFeed, document);
    return feedRoot
        ? feedRoot.name === "feed"
            ? getAtomFeed(feedRoot)
            : getRssFeed(feedRoot)
        : null;
}
/**
 * Parse an Atom feed.
 *
 * @param feedRoot The root of the feed.
 * @returns The parsed feed.
 */
function getAtomFeed(feedRoot) {
    const childs = feedRoot.children;
    const feed = {
        type: "atom",
        items: (0,_legacy_js__WEBPACK_IMPORTED_MODULE_0__.getElementsByTagName)("entry", childs).map((item) => {
            const { children } = item;
            const entry = { media: getMediaElements(children) };
            addConditionally(entry, "id", "id", children);
            addConditionally(entry, "title", "title", children);
            const href = getOneElement("link", children)?.attribs["href"];
            if (href) {
                entry.link = href;
            }
            const description = fetch("summary", children) || fetch("content", children);
            if (description) {
                entry.description = description;
            }
            const pubDate = fetch("updated", children);
            if (pubDate) {
                entry.pubDate = new Date(pubDate);
            }
            return entry;
        }),
    };
    addConditionally(feed, "id", "id", childs);
    addConditionally(feed, "title", "title", childs);
    const href = getOneElement("link", childs)?.attribs["href"];
    if (href) {
        feed.link = href;
    }
    addConditionally(feed, "description", "subtitle", childs);
    const updated = fetch("updated", childs);
    if (updated) {
        feed.updated = new Date(updated);
    }
    addConditionally(feed, "author", "email", childs, true);
    return feed;
}
/**
 * Parse a RSS feed.
 *
 * @param feedRoot The root of the feed.
 * @returns The parsed feed.
 */
function getRssFeed(feedRoot) {
    const childs = getOneElement("channel", feedRoot.children)?.children ?? [];
    const feed = {
        type: feedRoot.name.substr(0, 3),
        id: "",
        items: (0,_legacy_js__WEBPACK_IMPORTED_MODULE_0__.getElementsByTagName)("item", feedRoot.children).map((item) => {
            const { children } = item;
            const entry = { media: getMediaElements(children) };
            addConditionally(entry, "id", "guid", children);
            addConditionally(entry, "title", "title", children);
            addConditionally(entry, "link", "link", children);
            addConditionally(entry, "description", "description", children);
            const pubDate = fetch("pubDate", children) || fetch("dc:date", children);
            if (pubDate)
                entry.pubDate = new Date(pubDate);
            return entry;
        }),
    };
    addConditionally(feed, "title", "title", childs);
    addConditionally(feed, "link", "link", childs);
    addConditionally(feed, "description", "description", childs);
    const updated = fetch("lastBuildDate", childs);
    if (updated) {
        feed.updated = new Date(updated);
    }
    addConditionally(feed, "author", "managingEditor", childs, true);
    return feed;
}
const MEDIA_KEYS_STRING = ["url", "type", "lang"];
const MEDIA_KEYS_INT = [
    "fileSize",
    "bitrate",
    "framerate",
    "samplingrate",
    "channels",
    "duration",
    "height",
    "width",
];
/**
 * Get all media elements of a feed item.
 *
 * @param where Nodes to search in.
 * @returns Media elements.
 */
function getMediaElements(where) {
    return (0,_legacy_js__WEBPACK_IMPORTED_MODULE_0__.getElementsByTagName)("media:content", where).map((element) => {
        const { attribs } = element;
        const media = {
            medium: attribs["medium"],
            isDefault: !!attribs["isDefault"],
        };
        for (const attrib of MEDIA_KEYS_STRING) {
            if (attribs[attrib]) {
                media[attrib] = attribs[attrib];
            }
        }
        for (const attrib of MEDIA_KEYS_INT) {
            if (attribs[attrib]) {
                media[attrib] = Number.parseInt(attribs[attrib], 10);
            }
        }
        if (attribs["expression"]) {
            media.expression = attribs["expression"];
        }
        return media;
    });
}
/**
 * Get one element by tag name.
 *
 * @param tagName Tag name to look for
 * @param node Node to search in
 * @returns The element or null
 */
function getOneElement(tagName, node) {
    return (0,_legacy_js__WEBPACK_IMPORTED_MODULE_0__.getElementsByTagName)(tagName, node, true, 1)[0];
}
/**
 * Get the text content of an element with a certain tag name.
 *
 * @param tagName Tag name to look for.
 * @param where Node to search in.
 * @param recurse Whether to recurse into child nodes.
 * @returns The text content of the element.
 */
function fetch(tagName, where, recurse = false) {
    return (0,_stringify_js__WEBPACK_IMPORTED_MODULE_1__.textContent)((0,_legacy_js__WEBPACK_IMPORTED_MODULE_0__.getElementsByTagName)(tagName, where, recurse, 1)).trim();
}
/**
 * Adds a property to an object if it has a value.
 *
 * @param object Object to be extended.
 * @param property Property name.
 * @param tagName Tag name that contains the conditionally added property.
 * @param where Element to search for the property.
 * @param recurse Whether to recurse into child nodes.
 */
function addConditionally(object, property, tagName, where, recurse = false) {
    const value = fetch(tagName, where, recurse);
    if (value)
        object[property] = value;
}
/**
 * Checks if an element is a feed root node.
 *
 * @param value The name of the element to check.
 * @returns Whether an element is a feed root node.
 */
function isValidFeed(value) {
    return value === "rss" || value === "feed" || value === "rdf:RDF";
}
//# sourceMappingURL=feeds.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domutils/dist/helpers.js"
/*!**************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domutils/dist/helpers.js ***!
  \**************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   DocumentPosition: () => (/* binding */ DocumentPosition),
/* harmony export */   compareDocumentPosition: () => (/* binding */ compareDocumentPosition),
/* harmony export */   removeSubsets: () => (/* binding */ removeSubsets),
/* harmony export */   uniqueSort: () => (/* binding */ uniqueSort)
/* harmony export */ });
/* harmony import */ var domhandler__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! domhandler */ "./node_modules/sanitize-html/node_modules/domhandler/dist/node.js");

/**
 * Given an array of nodes, remove any member that is contained by another
 * member.
 *
 * @category Helpers
 * @param nodes Nodes to filter.
 * @returns Remaining nodes that aren't contained by other nodes.
 */
function removeSubsets(nodes) {
    let index = nodes.length;
    /*
     * Check if each node (or one of its ancestors) is already contained in the
     * array.
     */
    while (--index >= 0) {
        const node = nodes[index];
        /*
         * Remove the node if it is not unique.
         * We are going through the array from the end, so we only
         * have to check nodes that preceed the node under consideration in the array.
         */
        if (index > 0 && nodes.lastIndexOf(node, index - 1) >= 0) {
            nodes.splice(index, 1);
            continue;
        }
        for (let ancestor = node.parent; ancestor; ancestor = ancestor.parent) {
            if (nodes.includes(ancestor)) {
                nodes.splice(index, 1);
                break;
            }
        }
    }
    return nodes;
}
/**
 * @category Helpers
 * @see {@link http://dom.spec.whatwg.org/#dom-node-comparedocumentposition}
 */
var DocumentPosition;
(function (DocumentPosition) {
    DocumentPosition[DocumentPosition["DISCONNECTED"] = 1] = "DISCONNECTED";
    DocumentPosition[DocumentPosition["PRECEDING"] = 2] = "PRECEDING";
    DocumentPosition[DocumentPosition["FOLLOWING"] = 4] = "FOLLOWING";
    DocumentPosition[DocumentPosition["CONTAINS"] = 8] = "CONTAINS";
    DocumentPosition[DocumentPosition["CONTAINED_BY"] = 16] = "CONTAINED_BY";
})(DocumentPosition || (DocumentPosition = {}));
/**
 * Compare the position of one node against another node in any other document,
 * returning a bitmask with the values from {@link DocumentPosition}.
 *
 * Document order:
 * > There is an ordering, document order, defined on all the nodes in the
 * > document corresponding to the order in which the first character of the
 * > XML representation of each node occurs in the XML representation of the
 * > document after expansion of general entities. Thus, the document element
 * > node will be the first node. Element nodes occur before their children.
 * > Thus, document order orders element nodes in order of the occurrence of
 * > their start-tag in the XML (after expansion of entities). The attribute
 * > nodes of an element occur after the element and before its children. The
 * > relative order of attribute nodes is implementation-dependent.
 *
 * Source:
 * http://www.w3.org/TR/DOM-Level-3-Core/glossary.html#dt-document-order
 *
 * @category Helpers
 * @param nodeA The first node to use in the comparison
 * @param nodeB The second node to use in the comparison
 * @returns A bitmask describing the input nodes' relative position.
 *
 * See http://dom.spec.whatwg.org/#dom-node-comparedocumentposition for
 * a description of these values.
 */
function compareDocumentPosition(nodeA, nodeB) {
    const aParents = [];
    const bParents = [];
    if (nodeA === nodeB) {
        return 0;
    }
    let current = (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.hasChildren)(nodeA) ? nodeA : nodeA.parent;
    while (current) {
        aParents.unshift(current);
        current = current.parent;
    }
    current = (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.hasChildren)(nodeB) ? nodeB : nodeB.parent;
    while (current) {
        bParents.unshift(current);
        current = current.parent;
    }
    const maxIndex = Math.min(aParents.length, bParents.length);
    let index = 0;
    while (index < maxIndex && aParents[index] === bParents[index]) {
        index++;
    }
    if (index === 0) {
        return DocumentPosition.DISCONNECTED;
    }
    const sharedParent = aParents[index - 1];
    const siblings = sharedParent.children;
    const aSibling = aParents[index];
    const bSibling = bParents[index];
    if (siblings.indexOf(aSibling) > siblings.indexOf(bSibling)) {
        if (sharedParent === nodeB) {
            return DocumentPosition.FOLLOWING | DocumentPosition.CONTAINED_BY;
        }
        return DocumentPosition.FOLLOWING;
    }
    if (sharedParent === nodeA) {
        return DocumentPosition.PRECEDING | DocumentPosition.CONTAINS;
    }
    return DocumentPosition.PRECEDING;
}
/**
 * Sort an array of nodes based on their relative position in the document,
 * removing any duplicate nodes. If the array contains nodes that do not belong
 * to the same document, sort order is unspecified.
 *
 * @category Helpers
 * @param nodes Array of DOM nodes.
 * @returns Collection of unique nodes, sorted in document order.
 */
function uniqueSort(nodes) {
    nodes = nodes.filter((node, index, array) => !array.includes(node, index + 1));
    nodes.sort((a, b) => {
        const relative = compareDocumentPosition(a, b);
        if (relative & DocumentPosition.PRECEDING) {
            return -1;
        }
        if (relative & DocumentPosition.FOLLOWING) {
            return 1;
        }
        return 0;
    });
    return nodes;
}
//# sourceMappingURL=helpers.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domutils/dist/index.js"
/*!************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domutils/dist/index.js ***!
  \************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   DocumentPosition: () => (/* reexport safe */ _helpers_js__WEBPACK_IMPORTED_MODULE_1__.DocumentPosition),
/* harmony export */   append: () => (/* reexport safe */ _manipulation_js__WEBPACK_IMPORTED_MODULE_3__.append),
/* harmony export */   appendChild: () => (/* reexport safe */ _manipulation_js__WEBPACK_IMPORTED_MODULE_3__.appendChild),
/* harmony export */   compareDocumentPosition: () => (/* reexport safe */ _helpers_js__WEBPACK_IMPORTED_MODULE_1__.compareDocumentPosition),
/* harmony export */   existsOne: () => (/* reexport safe */ _querying_js__WEBPACK_IMPORTED_MODULE_4__.existsOne),
/* harmony export */   filter: () => (/* reexport safe */ _querying_js__WEBPACK_IMPORTED_MODULE_4__.filter),
/* harmony export */   find: () => (/* reexport safe */ _querying_js__WEBPACK_IMPORTED_MODULE_4__.find),
/* harmony export */   findAll: () => (/* reexport safe */ _querying_js__WEBPACK_IMPORTED_MODULE_4__.findAll),
/* harmony export */   findOne: () => (/* reexport safe */ _querying_js__WEBPACK_IMPORTED_MODULE_4__.findOne),
/* harmony export */   getAttributeValue: () => (/* reexport safe */ _traversal_js__WEBPACK_IMPORTED_MODULE_6__.getAttributeValue),
/* harmony export */   getChildren: () => (/* reexport safe */ _traversal_js__WEBPACK_IMPORTED_MODULE_6__.getChildren),
/* harmony export */   getElementById: () => (/* reexport safe */ _legacy_js__WEBPACK_IMPORTED_MODULE_2__.getElementById),
/* harmony export */   getElements: () => (/* reexport safe */ _legacy_js__WEBPACK_IMPORTED_MODULE_2__.getElements),
/* harmony export */   getElementsByClassName: () => (/* reexport safe */ _legacy_js__WEBPACK_IMPORTED_MODULE_2__.getElementsByClassName),
/* harmony export */   getElementsByTagName: () => (/* reexport safe */ _legacy_js__WEBPACK_IMPORTED_MODULE_2__.getElementsByTagName),
/* harmony export */   getElementsByTagType: () => (/* reexport safe */ _legacy_js__WEBPACK_IMPORTED_MODULE_2__.getElementsByTagType),
/* harmony export */   getFeed: () => (/* reexport safe */ _feeds_js__WEBPACK_IMPORTED_MODULE_0__.getFeed),
/* harmony export */   getInnerHTML: () => (/* reexport safe */ _stringify_js__WEBPACK_IMPORTED_MODULE_5__.getInnerHTML),
/* harmony export */   getName: () => (/* reexport safe */ _traversal_js__WEBPACK_IMPORTED_MODULE_6__.getName),
/* harmony export */   getOuterHTML: () => (/* reexport safe */ _stringify_js__WEBPACK_IMPORTED_MODULE_5__.getOuterHTML),
/* harmony export */   getParent: () => (/* reexport safe */ _traversal_js__WEBPACK_IMPORTED_MODULE_6__.getParent),
/* harmony export */   getSiblings: () => (/* reexport safe */ _traversal_js__WEBPACK_IMPORTED_MODULE_6__.getSiblings),
/* harmony export */   getText: () => (/* reexport safe */ _stringify_js__WEBPACK_IMPORTED_MODULE_5__.getText),
/* harmony export */   hasAttrib: () => (/* reexport safe */ _traversal_js__WEBPACK_IMPORTED_MODULE_6__.hasAttrib),
/* harmony export */   innerText: () => (/* reexport safe */ _stringify_js__WEBPACK_IMPORTED_MODULE_5__.innerText),
/* harmony export */   nextElementSibling: () => (/* reexport safe */ _traversal_js__WEBPACK_IMPORTED_MODULE_6__.nextElementSibling),
/* harmony export */   prepend: () => (/* reexport safe */ _manipulation_js__WEBPACK_IMPORTED_MODULE_3__.prepend),
/* harmony export */   prependChild: () => (/* reexport safe */ _manipulation_js__WEBPACK_IMPORTED_MODULE_3__.prependChild),
/* harmony export */   prevElementSibling: () => (/* reexport safe */ _traversal_js__WEBPACK_IMPORTED_MODULE_6__.prevElementSibling),
/* harmony export */   removeElement: () => (/* reexport safe */ _manipulation_js__WEBPACK_IMPORTED_MODULE_3__.removeElement),
/* harmony export */   removeSubsets: () => (/* reexport safe */ _helpers_js__WEBPACK_IMPORTED_MODULE_1__.removeSubsets),
/* harmony export */   replaceElement: () => (/* reexport safe */ _manipulation_js__WEBPACK_IMPORTED_MODULE_3__.replaceElement),
/* harmony export */   testElement: () => (/* reexport safe */ _legacy_js__WEBPACK_IMPORTED_MODULE_2__.testElement),
/* harmony export */   textContent: () => (/* reexport safe */ _stringify_js__WEBPACK_IMPORTED_MODULE_5__.textContent),
/* harmony export */   uniqueSort: () => (/* reexport safe */ _helpers_js__WEBPACK_IMPORTED_MODULE_1__.uniqueSort)
/* harmony export */ });
/* harmony import */ var _feeds_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./feeds.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/feeds.js");
/* harmony import */ var _helpers_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./helpers.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/helpers.js");
/* harmony import */ var _legacy_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./legacy.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/legacy.js");
/* harmony import */ var _manipulation_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./manipulation.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/manipulation.js");
/* harmony import */ var _querying_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./querying.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/querying.js");
/* harmony import */ var _stringify_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./stringify.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/stringify.js");
/* harmony import */ var _traversal_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./traversal.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/traversal.js");







//# sourceMappingURL=index.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domutils/dist/legacy.js"
/*!*************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domutils/dist/legacy.js ***!
  \*************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getElementById: () => (/* binding */ getElementById),
/* harmony export */   getElements: () => (/* binding */ getElements),
/* harmony export */   getElementsByClassName: () => (/* binding */ getElementsByClassName),
/* harmony export */   getElementsByTagName: () => (/* binding */ getElementsByTagName),
/* harmony export */   getElementsByTagType: () => (/* binding */ getElementsByTagType),
/* harmony export */   testElement: () => (/* binding */ testElement)
/* harmony export */ });
/* harmony import */ var domhandler__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! domhandler */ "./node_modules/sanitize-html/node_modules/domhandler/dist/node.js");
/* harmony import */ var _querying_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./querying.js */ "./node_modules/sanitize-html/node_modules/domutils/dist/querying.js");


/**
 * A map of functions to check nodes against.
 */
const Checks = {
    tag_name(name) {
        if (typeof name === "function") {
            return (element) => (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag)(element) && name(element.name);
        }
        if (name === "*") {
            return domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag;
        }
        return (element) => (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag)(element) && element.name === name;
    },
    tag_type(type) {
        if (typeof type === "function") {
            return (element) => type(element.type);
        }
        return (element) => element.type === type;
    },
    tag_contains(data) {
        if (typeof data === "function") {
            return (element) => (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isText)(element) && data(element.data);
        }
        return (element) => (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isText)(element) && element.data === data;
    },
};
/**
 * Returns a function to check whether a node has an attribute with a particular
 * value.
 *
 * @param attrib Attribute to check.
 * @param value Attribute value to look for.
 * @returns A function to check whether the a node has an attribute with a
 *   particular value.
 */
function getAttribCheck(attrib, value) {
    if (typeof value === "function") {
        return (element) => (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag)(element) && value(element.attribs[attrib]);
    }
    return (element) => (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag)(element) && element.attribs[attrib] === value;
}
/**
 * Returns a function that returns `true` if either of the input functions
 * returns `true` for a node.
 *
 * @param a First function to combine.
 * @param b Second function to combine.
 * @returns A function taking a node and returning `true` if either of the input
 *   functions returns `true` for the node.
 */
function combineFuncs(a, b) {
    return (element) => a(element) || b(element);
}
/**
 * Returns a function that executes all checks in `options` and returns `true`
 * if any of them match a node.
 *
 * @param options An object describing nodes to look for.
 * @returns A function that executes all checks in `options` and returns `true`
 *   if any of them match a node.
 */
function compileTest(options) {
    const funcs = Object.keys(options).map((key) => {
        const value = options[key];
        return Object.hasOwn(Checks, key)
            ? Checks[key](value)
            : getAttribCheck(key, value);
    });
    return funcs.length === 0 ? null : funcs.reduce(combineFuncs);
}
/**
 * Checks whether a node matches the description in `options`.
 *
 * @category Legacy Query Functions
 * @param options An object describing nodes to look for.
 * @param node The element to test.
 * @returns Whether the element matches the description in `options`.
 */
function testElement(options, node) {
    const test = compileTest(options);
    return test ? test(node) : true;
}
/**
 * Returns all nodes that match `options`.
 *
 * @category Legacy Query Functions
 * @param options An object describing nodes to look for.
 * @param nodes Nodes to search through.
 * @param recurse Also consider child nodes.
 * @param limit Maximum number of nodes to return.
 * @returns All nodes that match `options`.
 */
function getElements(options, nodes, recurse, limit = Number.POSITIVE_INFINITY) {
    const test = compileTest(options);
    return test ? (0,_querying_js__WEBPACK_IMPORTED_MODULE_1__.filter)(test, nodes, recurse, limit) : [];
}
/**
 * Returns the node with the supplied ID.
 *
 * @category Legacy Query Functions
 * @param id The unique ID attribute value to look for.
 * @param nodes Nodes to search through.
 * @param recurse Also consider child nodes.
 * @returns The node with the supplied ID.
 */
function getElementById(id, nodes, recurse = true) {
    if (!Array.isArray(nodes))
        nodes = [nodes];
    return (0,_querying_js__WEBPACK_IMPORTED_MODULE_1__.findOne)(getAttribCheck("id", id), nodes, recurse);
}
/**
 * Returns all nodes with the supplied `tagName`.
 *
 * @category Legacy Query Functions
 * @param tagName Tag name to search for.
 * @param nodes Nodes to search through.
 * @param recurse Also consider child nodes.
 * @param limit Maximum number of nodes to return.
 * @returns All nodes with the supplied `tagName`.
 */
function getElementsByTagName(tagName, nodes, recurse = true, limit = Number.POSITIVE_INFINITY) {
    return (0,_querying_js__WEBPACK_IMPORTED_MODULE_1__.filter)(Checks["tag_name"](tagName), nodes, recurse, limit);
}
/**
 * Returns all nodes with the supplied `className`.
 *
 * @category Legacy Query Functions
 * @param className Class name to search for.
 * @param nodes Nodes to search through.
 * @param recurse Also consider child nodes.
 * @param limit Maximum number of nodes to return.
 * @returns All nodes with the supplied `className`.
 */
function getElementsByClassName(className, nodes, recurse = true, limit = Number.POSITIVE_INFINITY) {
    return (0,_querying_js__WEBPACK_IMPORTED_MODULE_1__.filter)(getAttribCheck("class", className), nodes, recurse, limit);
}
/**
 * Returns all nodes with the supplied `type`.
 *
 * @category Legacy Query Functions
 * @param type Element type to look for.
 * @param nodes Nodes to search through.
 * @param recurse Also consider child nodes.
 * @param limit Maximum number of nodes to return.
 * @returns All nodes with the supplied `type`.
 */
function getElementsByTagType(type, nodes, recurse = true, limit = Number.POSITIVE_INFINITY) {
    return (0,_querying_js__WEBPACK_IMPORTED_MODULE_1__.filter)(Checks["tag_type"](type), nodes, recurse, limit);
}
//# sourceMappingURL=legacy.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domutils/dist/manipulation.js"
/*!*******************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domutils/dist/manipulation.js ***!
  \*******************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   append: () => (/* binding */ append),
/* harmony export */   appendChild: () => (/* binding */ appendChild),
/* harmony export */   prepend: () => (/* binding */ prepend),
/* harmony export */   prependChild: () => (/* binding */ prependChild),
/* harmony export */   removeElement: () => (/* binding */ removeElement),
/* harmony export */   replaceElement: () => (/* binding */ replaceElement)
/* harmony export */ });
/**
 * Remove an element from the dom
 *
 * @category Manipulation
 * @param element The element to be removed.
 */
function removeElement(element) {
    if (element.prev)
        element.prev.next = element.next;
    if (element.next)
        element.next.prev = element.prev;
    if (element.parent) {
        const childs = element.parent.children;
        const childsIndex = childs.lastIndexOf(element);
        if (childsIndex !== -1) {
            childs.splice(childsIndex, 1);
        }
    }
    element.next = null;
    element.prev = null;
    element.parent = null;
}
/**
 * Replace an element in the dom
 *
 * @category Manipulation
 * @param element The element to be replaced.
 * @param replacement The element to be added
 */
function replaceElement(element, replacement) {
    replacement.prev = element.prev;
    if (replacement.prev) {
        replacement.prev.next = replacement;
    }
    replacement.next = element.next;
    if (replacement.next) {
        replacement.next.prev = replacement;
    }
    replacement.parent = element.parent;
    if (replacement.parent) {
        const { children } = replacement.parent;
        const elementIndex = children.lastIndexOf(element);
        if (elementIndex === -1) {
            return;
        }
        children[elementIndex] = replacement;
        element.parent = null;
    }
}
/**
 * Append a child to an element.
 *
 * @category Manipulation
 * @param parent The element to append to.
 * @param child The element to be added as a child.
 */
function appendChild(parent, child) {
    removeElement(child);
    child.next = null;
    child.parent = parent;
    if (parent.children.push(child) > 1) {
        const sibling = parent.children[parent.children.length - 2];
        sibling.next = child;
        child.prev = sibling;
    }
    else {
        child.prev = null;
    }
}
/**
 * Append an element after another.
 *
 * @category Manipulation
 * @param element The element to append after.
 * @param next The element be added.
 */
function append(element, next) {
    removeElement(next);
    const { parent } = element;
    const currentNext = element.next;
    next.next = currentNext;
    next.prev = element;
    element.next = next;
    next.parent = parent;
    if (currentNext) {
        currentNext.prev = next;
        if (parent) {
            const childs = parent.children;
            childs.splice(childs.lastIndexOf(currentNext), 0, next);
        }
    }
    else if (parent) {
        parent.children.push(next);
    }
}
/**
 * Prepend a child to an element.
 *
 * @category Manipulation
 * @param parent The element to prepend before.
 * @param child The element to be added as a child.
 */
function prependChild(parent, child) {
    removeElement(child);
    child.parent = parent;
    child.prev = null;
    if (parent.children.unshift(child) === 1) {
        child.next = null;
    }
    else {
        const sibling = parent.children[1];
        sibling.prev = child;
        child.next = sibling;
    }
}
/**
 * Prepend an element before another.
 *
 * @category Manipulation
 * @param element The element to prepend before.
 * @param previous The element to be added.
 */
function prepend(element, previous) {
    removeElement(previous);
    const { parent } = element;
    if (parent) {
        const childs = parent.children;
        childs.splice(childs.indexOf(element), 0, previous);
    }
    if (element.prev) {
        element.prev.next = previous;
    }
    previous.parent = parent;
    previous.prev = element.prev;
    previous.next = element;
    element.prev = previous;
}
//# sourceMappingURL=manipulation.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domutils/dist/querying.js"
/*!***************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domutils/dist/querying.js ***!
  \***************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   existsOne: () => (/* binding */ existsOne),
/* harmony export */   filter: () => (/* binding */ filter),
/* harmony export */   find: () => (/* binding */ find),
/* harmony export */   findAll: () => (/* binding */ findAll),
/* harmony export */   findOne: () => (/* binding */ findOne)
/* harmony export */ });
/* harmony import */ var domhandler__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! domhandler */ "./node_modules/sanitize-html/node_modules/domhandler/dist/node.js");

/**
 * Search a node and its children for nodes passing a test function. If `node` is not an array, it will be wrapped in one.
 *
 * @category Querying
 * @param test Function to test nodes on.
 * @param node Node to search. Will be included in the result set if it matches.
 * @param recurse Also consider child nodes.
 * @param limit Maximum number of nodes to return.
 * @returns All nodes passing `test`.
 */
function filter(test, node, recurse = true, limit = Number.POSITIVE_INFINITY) {
    return find(test, Array.isArray(node) ? node : [node], recurse, limit);
}
/**
 * Search an array of nodes and their children for nodes passing a test function.
 *
 * @category Querying
 * @param test Function to test nodes on.
 * @param nodes Array of nodes to search.
 * @param recurse Also consider child nodes.
 * @param limit Maximum number of nodes to return.
 * @returns All nodes passing `test`.
 */
function find(test, nodes, recurse, limit) {
    const result = [];
    /** Stack of the arrays we are looking at. */
    const nodeStack = [Array.isArray(nodes) ? nodes : [nodes]];
    /** Stack of the indices within the arrays. */
    const indexStack = [0];
    for (;;) {
        // First, check if the current array has any more elements to look at.
        if (indexStack[0] >= nodeStack[0].length) {
            // If we have no more arrays to look at, we are done.
            if (indexStack.length === 1) {
                return result;
            }
            // Otherwise, remove the current array from the stack.
            nodeStack.shift();
            indexStack.shift();
            // Loop back to the start to continue with the next array.
            continue;
        }
        const element = nodeStack[0][indexStack[0]++];
        if (test(element)) {
            result.push(element);
            if (--limit <= 0)
                return result;
        }
        if (recurse && (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.hasChildren)(element) && element.children.length > 0) {
            /*
             * Add the children to the stack. We are depth-first, so this is
             * the next array we look at.
             */
            indexStack.unshift(0);
            nodeStack.unshift(element.children);
        }
    }
}
/**
 * Finds one element in a tree that passes a test.
 *
 * @category Querying
 * @param test Function to test nodes on.
 * @param nodes Node or array of nodes to search.
 * @param recurse Also consider child nodes.
 * @returns The first node that passes `test`.
 */
function findOne(test, nodes, recurse = true) {
    const searchedNodes = Array.isArray(nodes) ? nodes : [nodes];
    for (const node of searchedNodes) {
        if ((0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag)(node) && test(node)) {
            return node;
        }
        if (recurse && (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.hasChildren)(node) && node.children.length > 0) {
            const found = findOne(test, node.children, true);
            if (found)
                return found;
        }
    }
    return null;
}
/**
 * Checks if a tree of nodes contains at least one node passing a test.
 *
 * @category Querying
 * @param test Function to test nodes on.
 * @param nodes Array of nodes to search.
 * @returns Whether a tree of nodes contains at least one node passing the test.
 */
function existsOne(test, nodes) {
    return (Array.isArray(nodes) ? nodes : [nodes]).some((node) => ((0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag)(node) && test(node)) ||
        ((0,domhandler__WEBPACK_IMPORTED_MODULE_0__.hasChildren)(node) && existsOne(test, node.children)));
}
/**
 * Search an array of nodes and their children for elements passing a test function.
 *
 * Same as `find`, but limited to elements and with less options, leading to reduced complexity.
 *
 * @category Querying
 * @param test Function to test nodes on.
 * @param nodes Array of nodes to search.
 * @returns All nodes passing `test`.
 */
function findAll(test, nodes) {
    const result = [];
    const nodeStack = [Array.isArray(nodes) ? nodes : [nodes]];
    const indexStack = [0];
    for (;;) {
        if (indexStack[0] >= nodeStack[0].length) {
            if (nodeStack.length === 1) {
                return result;
            }
            // Otherwise, remove the current array from the stack.
            nodeStack.shift();
            indexStack.shift();
            // Loop back to the start to continue with the next array.
            continue;
        }
        const element = nodeStack[0][indexStack[0]++];
        if ((0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag)(element) && test(element))
            result.push(element);
        if ((0,domhandler__WEBPACK_IMPORTED_MODULE_0__.hasChildren)(element) && element.children.length > 0) {
            indexStack.unshift(0);
            nodeStack.unshift(element.children);
        }
    }
}
//# sourceMappingURL=querying.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domutils/dist/stringify.js"
/*!****************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domutils/dist/stringify.js ***!
  \****************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getInnerHTML: () => (/* binding */ getInnerHTML),
/* harmony export */   getOuterHTML: () => (/* binding */ getOuterHTML),
/* harmony export */   getText: () => (/* binding */ getText),
/* harmony export */   innerText: () => (/* binding */ innerText),
/* harmony export */   textContent: () => (/* binding */ textContent)
/* harmony export */ });
/* harmony import */ var dom_serializer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! dom-serializer */ "./node_modules/sanitize-html/node_modules/dom-serializer/dist/index.js");
/* harmony import */ var domelementtype__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! domelementtype */ "./node_modules/sanitize-html/node_modules/domelementtype/dist/index.js");
/* harmony import */ var domhandler__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! domhandler */ "./node_modules/sanitize-html/node_modules/domhandler/dist/node.js");



/**
 * @category Stringify
 * @deprecated Use the `dom-serializer` module directly.
 * @param node Node to get the outer HTML of.
 * @param options Options for serialization.
 * @returns `node`'s outer HTML.
 */
function getOuterHTML(node, options) {
    return (0,dom_serializer__WEBPACK_IMPORTED_MODULE_0__["default"])(node, options);
}
/**
 * @category Stringify
 * @deprecated Use the `dom-serializer` module directly.
 * @param node Node to get the inner HTML of.
 * @param options Options for serialization.
 * @returns `node`'s inner HTML.
 */
function getInnerHTML(node, options) {
    return (0,domhandler__WEBPACK_IMPORTED_MODULE_2__.hasChildren)(node)
        ? node.children.map((node) => getOuterHTML(node, options)).join("")
        : "";
}
/**
 * Get a node's inner text. Same as `textContent`, but inserts newlines for `<br>` tags. Ignores comments.
 *
 * @category Stringify
 * @deprecated Use `textContent` instead.
 * @param node Node to get the inner text of.
 * @returns `node`'s inner text.
 */
function getText(node) {
    if (Array.isArray(node))
        return node.map(getText).join("");
    if ((0,domhandler__WEBPACK_IMPORTED_MODULE_2__.isTag)(node))
        return node.name === "br" ? "\n" : getText(node.children);
    if ((0,domhandler__WEBPACK_IMPORTED_MODULE_2__.isCDATA)(node))
        return getText(node.children);
    if ((0,domhandler__WEBPACK_IMPORTED_MODULE_2__.isText)(node))
        return node.data;
    return "";
}
/**
 * Get a node's text content. Ignores comments.
 *
 * @category Stringify
 * @param node Node to get the text content of.
 * @returns `node`'s text content.
 * @see {@link https://developer.mozilla.org/en-US/docs/Web/API/Node/textContent}
 */
function textContent(node) {
    if (Array.isArray(node))
        return node.map(textContent).join("");
    if ((0,domhandler__WEBPACK_IMPORTED_MODULE_2__.hasChildren)(node) && !(0,domhandler__WEBPACK_IMPORTED_MODULE_2__.isComment)(node)) {
        return textContent(node.children);
    }
    if ((0,domhandler__WEBPACK_IMPORTED_MODULE_2__.isText)(node))
        return node.data;
    return "";
}
/**
 * Get a node's inner text, ignoring `<script>` and `<style>` tags. Ignores comments.
 *
 * @category Stringify
 * @param node Node to get the inner text of.
 * @returns `node`'s inner text.
 * @see {@link https://developer.mozilla.org/en-US/docs/Web/API/Node/innerText}
 */
function innerText(node) {
    if (Array.isArray(node))
        return node.map(innerText).join("");
    if ((0,domhandler__WEBPACK_IMPORTED_MODULE_2__.hasChildren)(node) && (node.type === domelementtype__WEBPACK_IMPORTED_MODULE_1__.ElementType.Tag || (0,domhandler__WEBPACK_IMPORTED_MODULE_2__.isCDATA)(node))) {
        return innerText(node.children);
    }
    if ((0,domhandler__WEBPACK_IMPORTED_MODULE_2__.isText)(node))
        return node.data;
    return "";
}
//# sourceMappingURL=stringify.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/domutils/dist/traversal.js"
/*!****************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/domutils/dist/traversal.js ***!
  \****************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getAttributeValue: () => (/* binding */ getAttributeValue),
/* harmony export */   getChildren: () => (/* binding */ getChildren),
/* harmony export */   getName: () => (/* binding */ getName),
/* harmony export */   getParent: () => (/* binding */ getParent),
/* harmony export */   getSiblings: () => (/* binding */ getSiblings),
/* harmony export */   hasAttrib: () => (/* binding */ hasAttrib),
/* harmony export */   nextElementSibling: () => (/* binding */ nextElementSibling),
/* harmony export */   prevElementSibling: () => (/* binding */ prevElementSibling)
/* harmony export */ });
/* harmony import */ var domhandler__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! domhandler */ "./node_modules/sanitize-html/node_modules/domhandler/dist/node.js");

/**
 * Get a node's children.
 *
 * @category Traversal
 * @param element Node to get the children of.
 * @returns `element`'s children, or an empty array.
 */
function getChildren(element) {
    return (0,domhandler__WEBPACK_IMPORTED_MODULE_0__.hasChildren)(element) ? element.children : [];
}
function getParent(element) {
    return element.parent || null;
}
/**
 * Gets an elements siblings, including the element itself.
 *
 * Attempts to get the children through the element's parent first. If we don't
 * have a parent (the element is a root node), we walk the element's `prev` &
 * `next` to get all remaining nodes.
 *
 * @category Traversal
 * @param element Element to get the siblings of.
 * @returns `element`'s siblings, including `element`.
 */
function getSiblings(element) {
    const parent = getParent(element);
    if (parent != null)
        return getChildren(parent);
    const siblings = [element];
    let { prev, next } = element;
    while (prev != null) {
        siblings.unshift(prev);
        ({ prev } = prev);
    }
    while (next != null) {
        siblings.push(next);
        ({ next } = next);
    }
    return siblings;
}
/**
 * Gets an attribute from an element.
 *
 * @category Traversal
 * @param element Element to check.
 * @param name Attribute name to retrieve.
 * @returns The element's attribute value, or `undefined`.
 */
function getAttributeValue(element, name) {
    const { attribs } = element;
    return attribs?.[name];
}
/**
 * Checks whether an element has an attribute.
 *
 * @category Traversal
 * @param element Element to check.
 * @param name Attribute name to look for.
 * @returns Returns whether `element` has the attribute `name`.
 */
function hasAttrib(element, name) {
    const { attribs } = element;
    return (attribs != null && Object.hasOwn(attribs, name) && attribs[name] != null);
}
/**
 * Get the tag name of an element.
 *
 * @category Traversal
 * @param element The element to get the name for.
 * @returns The tag name of `element`.
 */
function getName(element) {
    return element.name;
}
/**
 * Returns the next element sibling of a node.
 *
 * @category Traversal
 * @param element The element to get the next sibling of.
 * @returns `element`'s next sibling that is a tag, or `null` if there is no next
 * sibling.
 */
function nextElementSibling(element) {
    let { next } = element;
    while (next !== null && !(0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag)(next))
        ({ next } = next);
    return next;
}
/**
 * Returns the previous element sibling of a node.
 *
 * @category Traversal
 * @param element The element to get the previous sibling of.
 * @returns `element`'s previous sibling that is a tag, or `null` if there is no
 * previous sibling.
 */
// eslint-disable-next-line unicorn/prevent-abbreviations -- Keep public API name for backwards compatibility.
function prevElementSibling(element) {
    let { prev } = element;
    while (prev !== null && !(0,domhandler__WEBPACK_IMPORTED_MODULE_0__.isTag)(prev))
        ({ prev } = prev);
    return prev;
}
//# sourceMappingURL=traversal.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/entities/dist/decode-codepoint.js"
/*!***********************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/entities/dist/decode-codepoint.js ***!
  \***********************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   codePointToString: () => (/* binding */ codePointToString),
/* harmony export */   replaceCodePoint: () => (/* binding */ replaceCodePoint),
/* harmony export */   replaceCodePointXML: () => (/* binding */ replaceCodePointXML)
/* harmony export */ });
// Adapted from https://github.com/mathiasbynens/he/blob/36afe179392226cf1b6ccdb16ebbb7a5a844d93a/src/he.js#L106-L134
/**
 * C1 Unicode control character reference replacements (code points 128–159).
 * Index i gives the replacement for code point 128+i; 0 means "no replacement".
 */
const c1 = [
    8364, 0, 8218, 402, 8222, 8230, 8224, 8225, 710, 8240, 352, 8249, 338, 0,
    381, 0, 0, 8216, 8217, 8220, 8221, 8226, 8211, 8212, 732, 8482, 353, 8250,
    339, 0, 382, 376,
];
/**
 * True for NUL, UTF-16 surrogates, and values past U+10FFFF.
 * @param codePoint Unicode code point to check.
 */
function isInvalidCodePoint(codePoint) {
    return (codePoint === 0 ||
        (codePoint >= 0xd8_00 && codePoint <= 0xdf_ff) ||
        codePoint > 0x10_ff_ff);
}
/**
 * Replace the given code point with U+FFFD if it is NUL (0), a surrogate, or
 * outside the valid Unicode range. Code points in the C1 controls range
 * (128–159) are remapped to their Windows-1252 equivalents, following the
 * HTML spec. All other code points are returned unchanged.
 * @param codePoint Unicode code point to convert.
 */
function replaceCodePoint(codePoint) {
    if (isInvalidCodePoint(codePoint)) {
        return 0xff_fd;
    }
    if (codePoint >= 128 && codePoint <= 159) {
        return c1[codePoint - 128] || codePoint;
    }
    return codePoint;
}
/**
 * XML numeric character references are the referenced Unicode code point.
 * Invalid values still become U+FFFD; the HTML Windows-1252 C1 remap is not
 * applied.
 * @see https://www.w3.org/TR/xml/#NT-CharRef
 * @param codePoint Unicode code point to convert.
 */
function replaceCodePointXML(codePoint) {
    return isInvalidCodePoint(codePoint) ? 0xff_fd : codePoint;
}
/**
 * Convert the code point of a decoded numeric entity to a string, replacing
 * invalid values.
 *
 * Fast path for plain BMP code points: [1..0x7F] and [0xA0..0xD7FF] pass
 * `replaceCodePoint` unchanged (no NUL, C1 remap, surrogate, or out-of-range
 * handling) and fit a single charCode. 0xd760 = 0xD800 (the first surrogate)
 * - 0xA0.
 * @param codePoint Unicode code point to convert.
 */
function codePointToString(codePoint) {
    return (codePoint - 1) >>> 0 < 0x7f || (codePoint - 0xa0) >>> 0 < 0xd7_60
        ? String.fromCharCode(codePoint)
        : String.fromCodePoint(replaceCodePoint(codePoint));
}
//# sourceMappingURL=decode-codepoint.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/entities/dist/decode.js"
/*!*************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/entities/dist/decode.js ***!
  \*************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   DecodingMode: () => (/* binding */ DecodingMode),
/* harmony export */   EntityDecoder: () => (/* binding */ EntityDecoder),
/* harmony export */   decodeHTML: () => (/* binding */ decodeHTML),
/* harmony export */   decodeHTMLAttribute: () => (/* binding */ decodeHTMLAttribute),
/* harmony export */   decodeHTMLStrict: () => (/* binding */ decodeHTMLStrict),
/* harmony export */   decodeXML: () => (/* binding */ decodeXML),
/* harmony export */   determineBranch: () => (/* binding */ determineBranch),
/* harmony export */   htmlDecodeTree: () => (/* reexport safe */ _generated_decode_data_html_js__WEBPACK_IMPORTED_MODULE_1__.htmlDecodeTree),
/* harmony export */   xmlDecodeTree: () => (/* reexport safe */ _generated_decode_data_xml_js__WEBPACK_IMPORTED_MODULE_2__.xmlDecodeTree)
/* harmony export */ });
/* empty/unused harmony star reexport */
/* empty/unused harmony star reexport */
/* harmony import */ var _decode_codepoint_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./decode-codepoint.js */ "./node_modules/sanitize-html/node_modules/entities/dist/decode-codepoint.js");
/* harmony import */ var _generated_decode_data_html_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./generated/decode-data-html.js */ "./node_modules/sanitize-html/node_modules/entities/dist/generated/decode-data-html.js");
/* harmony import */ var _generated_decode_data_xml_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./generated/decode-data-xml.js */ "./node_modules/sanitize-html/node_modules/entities/dist/generated/decode-data-xml.js");
/* harmony import */ var _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./internal/bin-trie-flags.js */ "./node_modules/sanitize-html/node_modules/entities/dist/internal/bin-trie-flags.js");




var CharCodes;
(function (CharCodes) {
    CharCodes[CharCodes["AMP"] = 38] = "AMP";
    CharCodes[CharCodes["NUM"] = 35] = "NUM";
    CharCodes[CharCodes["SEMI"] = 59] = "SEMI";
    CharCodes[CharCodes["EQUALS"] = 61] = "EQUALS";
    CharCodes[CharCodes["ZERO"] = 48] = "ZERO";
    CharCodes[CharCodes["NINE"] = 57] = "NINE";
    CharCodes[CharCodes["LOWER_A"] = 97] = "LOWER_A";
    CharCodes[CharCodes["LOWER_X"] = 120] = "LOWER_X";
})(CharCodes || (CharCodes = {}));
/** Bit that needs to be set to convert an upper case ASCII character to lower case */
const TO_LOWER_BIT = 0b10_0000;
/*
 * `parseNumericEntity` packs its two results into one 32-bit integer:
 * `(consumed << CONSUMED_SHIFT) | codePoint`. The 21-bit code point field
 * fits any valid Unicode value (max 0x10FFFF, clamped before packing); the
 * consumed count excludes `&` and gets the remaining 11 bits. Extract it
 * with `>>>` so the topmost bit isn't treated as a sign.
 *
 * Plain consts rather than a `const enum`: with `isolatedModules`, enum
 * member reads compile to runtime property loads.
 */
const CONSUMED_SHIFT = 21;
const CODE_POINT_MASK = 0x1f_ff_ff;
/**
 * Reserved consumed field for counts of at least 2047 characters after `&`.
 * The true count is in `longNumericConsumed`.
 */
const CONSUMED_OVERFLOW = 0x7_ff;
/**
 * Side channel for numeric entities of at least 2048 characters including
 * `&`. Set by `parseNumericEntity` when its consumed count reaches the
 * reserved value `CONSUMED_OVERFLOW`; callers read the true count from here.
 * A module-level slot avoids a tuple allocation on the hot path.
 */
let longNumericConsumed = 0;
/**
 * Extract the consumed count from a `parseNumericEntity` packed result,
 * recovering the true length from `longNumericConsumed` when the packed
 * field contains the sentinel. Read it before the next `parseNumericEntity`
 * call, which may overwrite the side channel. This helper owns that protocol.
 * @param packed Packed result of `parseNumericEntity`.
 */
function unpackConsumed(packed) {
    const consumed = packed >>> CONSUMED_SHIFT;
    return consumed === CONSUMED_OVERFLOW ? longNumericConsumed : consumed;
}
/**
 * Unsigned subtraction trick: (code - lo) >>> 0 wraps negatives to large
 * values, so a single `<=` covers the entire [lo..hi] range check.
 * @param code Code point to check.
 */
function isNumber(code) {
    return (code - CharCodes.ZERO) >>> 0 <= 9;
}
function isHexadecimalCharacter(code) {
    return ((code | TO_LOWER_BIT) - CharCodes.LOWER_A) >>> 0 <= 5; // F - a
}
function isAlpha(code) {
    return ((code | TO_LOWER_BIT) - CharCodes.LOWER_A) >>> 0 <= 25; // Z - a
}
/**
 * Checks if the given character is a valid end character for an entity in an attribute.
 *
 * Attribute values that aren't terminated properly aren't parsed, and shouldn't lead to a parser error.
 * See the example in https://html.spec.whatwg.org/multipage/parsing.html#named-character-reference-state
 * @param code Code point to check.
 */
function isEntityInAttributeInvalidEnd(code) {
    return code === CharCodes.EQUALS || isAlpha(code) || isNumber(code);
}
var EntityDecoderState;
(function (EntityDecoderState) {
    EntityDecoderState[EntityDecoderState["EntityStart"] = 0] = "EntityStart";
    EntityDecoderState[EntityDecoderState["NumericStart"] = 1] = "NumericStart";
    EntityDecoderState[EntityDecoderState["NumericDecimal"] = 2] = "NumericDecimal";
    EntityDecoderState[EntityDecoderState["NumericHex"] = 3] = "NumericHex";
    EntityDecoderState[EntityDecoderState["NamedEntity"] = 4] = "NamedEntity";
})(EntityDecoderState || (EntityDecoderState = {}));
/**
 * Decoding mode for named entities.
 */
var DecodingMode;
(function (DecodingMode) {
    /** Entities in text nodes that can end with any character. */
    DecodingMode[DecodingMode["Legacy"] = 0] = "Legacy";
    /** Only allow entities terminated with a semicolon. */
    DecodingMode[DecodingMode["Strict"] = 1] = "Strict";
    /** Entities in attributes have limitations on ending characters. */
    DecodingMode[DecodingMode["Attribute"] = 2] = "Attribute";
})(DecodingMode || (DecodingMode = {}));
/**
 * Token decoder with support of writing partial entities.
 */
class EntityDecoder {
    decodeTree;
    emitCodePoint;
    errors;
    /** The current state of the decoder. */
    state = EntityDecoderState.EntityStart;
    /** Characters that were consumed while parsing an entity. */
    consumed = 1;
    /**
     * The result of the entity.
     *
     * For named entities: the trie index of the best legacy match so far
     * (0 = none). For numeric entities: the accumulated code point.
     */
    result = 0;
    /** The current index in the decode tree. */
    treeIndex = 0;
    /**
     * Characters consumed since the last recorded legacy match, plus one.
     * Invariant at the top of the `stateNamedEntity` loop: `excess` equals
     * the number of unrecorded consumed characters + 1.
     */
    // biome-ignore lint/correctness/noUnusedPrivateClassMembers: False positive (read via destructuring)
    excess = 1;
    /** The mode in which the decoder is operating. */
    decodeMode = DecodingMode.Strict;
    /** The number of characters that have been consumed in the current run. */
    // biome-ignore lint/correctness/noUnusedPrivateClassMembers: False positive
    runConsumed = 0;
    constructor(
    /** The predefined HTML or XML decode tree. */
    decodeTree, 
    /**
     * The function that is called when a codepoint is decoded.
     *
     * For named entities that decode to multiple code points, this will
     * be called multiple times, with the second codepoint, and the same
     * `consumed` value.
     * @param codepoint The decoded codepoint.
     * @param consumed The number of characters consumed by the decoder.
     */
    emitCodePoint, 
    /** An object that is used to produce errors. */
    errors) {
        this.decodeTree = decodeTree;
        this.emitCodePoint = emitCodePoint;
        this.errors = errors;
    }
    /**
     * Resets the instance to make it reusable.
     * @param decodeMode Entity decoding mode to use.
     */
    startEntity(decodeMode) {
        this.decodeMode = decodeMode;
        this.state = EntityDecoderState.EntityStart;
        this.result = 0;
        this.treeIndex = 0;
        this.excess = 1;
        this.consumed = 1;
        this.runConsumed = 0;
    }
    /**
     * Write an entity to the decoder. This can be called multiple times with partial entities.
     * If the entity is incomplete, the decoder will return -1.
     *
     * Mirrors the non-streaming `decodeWithTrie`, but with the ability to stop decoding if the
     * entity is incomplete, and resume when the next string is written.
     * @param input The string containing the entity (or a continuation of the entity).
     * @param offset The offset at which the entity begins. Should be 0 if this is not the first call.
     * @returns The number of characters that were consumed, or -1 if the entity is incomplete.
     */
    write(input, offset) {
        switch (this.state) {
            case EntityDecoderState.EntityStart: {
                if (input.charCodeAt(offset) === CharCodes.NUM) {
                    this.state = EntityDecoderState.NumericStart;
                    this.consumed += 1;
                    return this.stateNumericStart(input, offset + 1);
                }
                this.state = EntityDecoderState.NamedEntity;
                return this.stateNamedEntity(input, offset);
            }
            case EntityDecoderState.NumericStart: {
                return this.stateNumericStart(input, offset);
            }
            case EntityDecoderState.NumericDecimal: {
                return this.stateNumericDecimal(input, offset);
            }
            case EntityDecoderState.NumericHex: {
                return this.stateNumericHex(input, offset);
            }
            default: {
                // NamedEntity — the only remaining state.
                return this.stateNamedEntity(input, offset);
            }
        }
    }
    /**
     * Switches between the numeric decimal and hexadecimal states.
     *
     * Equivalent to the `Numeric character reference state` in the HTML spec.
     * @param input The string containing the entity (or a continuation of the entity).
     * @param offset The current offset.
     * @returns The number of characters that were consumed, or -1 if the entity is incomplete.
     */
    // eslint-disable-next-line unicorn/consistent-class-member-order
    stateNumericStart(input, offset) {
        if (offset >= input.length) {
            return -1;
        }
        if ((input.charCodeAt(offset) | TO_LOWER_BIT) === CharCodes.LOWER_X) {
            this.state = EntityDecoderState.NumericHex;
            this.consumed += 1;
            return this.stateNumericHex(input, offset + 1);
        }
        this.state = EntityDecoderState.NumericDecimal;
        return this.stateNumericDecimal(input, offset);
    }
    /**
     * Parses a hexadecimal numeric entity.
     *
     * Equivalent to the `Hexademical character reference state` in the HTML
     * spec. Digit parsing matches the hex loop in `parseNumericEntity`.
     * The accumulated value is preserved for numeric validation callbacks.
     * @param input The string containing the entity (or a continuation of the entity).
     * @param offset The current offset.
     * @returns The number of characters that were consumed, or -1 if the entity is incomplete.
     */
    stateNumericHex(input, offset) {
        const inputLength = input.length;
        // Local accumulators; flushed before any exit (see stateNamedEntity).
        let { result } = this;
        let { consumed } = this;
        while (offset < inputLength) {
            const char = input.charCodeAt(offset);
            if (isNumber(char) || isHexadecimalCharacter(char)) {
                // Convert hex digit to value (0-15); 'a'/'A' -> 10.
                const digit = char <= CharCodes.NINE
                    ? char - CharCodes.ZERO
                    : (char | TO_LOWER_BIT) - CharCodes.LOWER_A + 10;
                result = result * 16 + digit;
                consumed += 1;
                offset += 1;
            }
            else {
                this.result = result;
                this.consumed = consumed;
                return this.emitNumericEntity(char, 3);
            }
        }
        this.result = result;
        this.consumed = consumed;
        return -1; // Incomplete entity
    }
    /**
     * Parses a decimal numeric entity.
     *
     * Equivalent to the `Decimal character reference state` in the HTML
     * spec. Digit parsing matches the decimal loop in `parseNumericEntity`.
     * The accumulated value is preserved for numeric validation callbacks.
     * @param input The string containing the entity (or a continuation of the entity).
     * @param offset The current offset.
     * @returns The number of characters that were consumed, or -1 if the entity is incomplete.
     */
    stateNumericDecimal(input, offset) {
        const inputLength = input.length;
        // Local accumulators; flushed before any exit (see stateNamedEntity).
        let { result } = this;
        let { consumed } = this;
        while (offset < inputLength) {
            const digit = input.charCodeAt(offset) - CharCodes.ZERO;
            if (digit >>> 0 > 9) {
                this.result = result;
                this.consumed = consumed;
                return this.emitNumericEntity(digit + CharCodes.ZERO, 2);
            }
            result = result * 10 + digit;
            consumed += 1;
            offset += 1;
        }
        this.result = result;
        this.consumed = consumed;
        return -1; // Incomplete entity
    }
    /**
     * Validate and emit a numeric entity.
     *
     * Implements the logic from the `Hexademical character reference start
     * state` and `Numeric character reference end state` in the HTML spec.
     * @param lastCp The last code point of the entity. Used to see if the
     *               entity was terminated with a semicolon.
     * @param expectedLength The minimum number of characters that should be
     *                       consumed. Used to validate that at least one digit
     *                       was consumed.
     * @returns The number of characters that were consumed.
     */
    emitNumericEntity(lastCp, expectedLength) {
        // Ensure we consumed at least one digit.
        if (this.consumed <= expectedLength) {
            this.errors?.absenceOfDigitsInNumericCharacterReference(this.consumed);
            return 0;
        }
        // Figure out if this is a legit end of the entity
        if (lastCp === CharCodes.SEMI) {
            this.consumed += 1;
        }
        else if (this.decodeMode === DecodingMode.Strict) {
            return 0;
        }
        this.emitCodePoint((this.decodeTree === _generated_decode_data_xml_js__WEBPACK_IMPORTED_MODULE_2__.xmlDecodeTree
            ? _decode_codepoint_js__WEBPACK_IMPORTED_MODULE_0__.replaceCodePointXML
            : _decode_codepoint_js__WEBPACK_IMPORTED_MODULE_0__.replaceCodePoint)(this.result), this.consumed);
        if (this.errors) {
            if (lastCp !== CharCodes.SEMI) {
                this.errors.missingSemicolonAfterCharacterReference();
            }
            this.errors.validateNumericCharacterReference(this.result);
        }
        return this.consumed;
    }
    /**
     * Flush locally-tracked walk state back to the fields, then emit the
     * recorded legacy match or reject (cold path — at most once per
     * entity). Called after failed navigation (leaf node, branch miss, or
     * compact-run mismatch). In attribute mode, reject if no legacy was
     * recorded at the current node, if we descended past it, or if the
     * pending input character is an invalid attribute terminator.
     * @param consumed Locally-tracked consumed count.
     * @param excess Locally-tracked excess count.
     * @param char Pending input character (may be the mismatching char).
     * @param valueLength Value length at the current trie node.
     */
    flushAndEmitLegacyOrReject(consumed, excess, char, valueLength) {
        this.consumed = consumed;
        this.excess = excess;
        return this.result === 0 ||
            (this.decodeMode === DecodingMode.Attribute &&
                (valueLength === 0 ||
                    excess > 1 ||
                    isEntityInAttributeInvalidEnd(char)))
            ? 0
            : this.emitNotTerminatedNamedEntity();
    }
    /**
     * Parses a named entity.
     *
     * Equivalent to the `Named character reference state` in the HTML spec.
     * @param input The string containing the entity (or a continuation of the entity).
     * @param offset The current offset.
     * @returns The number of characters that were consumed, or -1 if the entity is incomplete.
     */
    stateNamedEntity(input, offset) {
        const { decodeTree } = this;
        const inputLength = input.length;
        const isStrict = this.decodeMode === DecodingMode.Strict;
        /*
         * Local copies of the resumable walk state avoid per-character
         * field writes. They are flushed back to the fields
         * on every exit (chunk end, and before any emit helper that reads
         * them). `this.result` is only written at the (rare) record points,
         * so it stays a direct field write.
         *
         * Legacy-match recording happens in two idempotent places: at the
         * loop top when sitting on a value node, and in the chunk-end
         * epilogue (so `end()` sees matches that land exactly on a chunk
         * boundary). Recording applies `consumed += excess - 1; excess = 1`,
         * which is a no-op when repeated — the loop-top invariant is
         * `excess` = unrecorded consumed characters + 1.
         */
        let { treeIndex } = this;
        let { excess } = this;
        let { consumed } = this;
        let current = decodeTree[treeIndex];
        while (offset < inputLength) {
            /*
             * Descend through value-less jump-table nodes (including the
             * single-branch encoding) inline, mirroring `decodeWithTrie`:
             * this avoids a `determineBranch` call per level for the
             * dominant node shape — including the root on the first write.
             */
            while ((current &
                (_internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.VALUE_LENGTH | _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13)) ===
                0 &&
                (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.JUMP_TABLE) !== 0) {
                const char = input.charCodeAt(offset);
                const jumpOffset = current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.JUMP_TABLE;
                const branchCount = (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.BRANCH_LENGTH) >> 7;
                if (branchCount === 0) {
                    // Single branch encoded inline in the jump offset bits.
                    if (char !== jumpOffset) {
                        return this.flushAndEmitLegacyOrReject(consumed, excess, char, 0);
                    }
                    treeIndex += 1;
                }
                else {
                    const slot = char - jumpOffset;
                    if (slot >>> 0 >= branchCount) {
                        return this.flushAndEmitLegacyOrReject(consumed, excess, char, 0);
                    }
                    const stored = decodeTree[treeIndex + 1 + slot];
                    if (stored === 0) {
                        return this.flushAndEmitLegacyOrReject(consumed, excess, char, 0);
                    }
                    // End-relative: branch data ends at treeIndex+1+branchCount.
                    treeIndex = (treeIndex + branchCount + stored) & 0xff_ff;
                }
                current = decodeTree[treeIndex];
                offset += 1;
                excess += 1;
                /*
                 * `charCodeAt` past the end returns NaN, which would alias
                 * to slot 0 after `>>> 0` — bail out explicitly.
                 */
                // eslint-disable-next-line unicorn/no-break-in-nested-loop
                if (offset >= inputLength)
                    break;
            }
            if (offset >= inputLength)
                break;
            // Handle compact runs (resumable across chunks).
            if ((current &
                (_internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.VALUE_LENGTH | _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13)) ===
                _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13) {
                const runLength = (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.BRANCH_LENGTH) >> 7; /* 3..63 */
                let { runConsumed } = this;
                // If we are starting a run, check the first char.
                if (runConsumed === 0) {
                    const char = input.charCodeAt(offset);
                    if (char !== (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.JUMP_TABLE)) {
                        return this.flushAndEmitLegacyOrReject(consumed, excess, char, 0);
                    }
                    offset += 1;
                    excess += 1;
                    runConsumed = 1;
                }
                // Check remaining characters in the run (packed two per uint16 word).
                while (runConsumed < runLength) {
                    if (offset >= inputLength) {
                        this.treeIndex = treeIndex;
                        this.excess = excess;
                        this.consumed = consumed;
                        this.runConsumed = runConsumed;
                        return -1;
                    }
                    const charIndexInPacked = runConsumed - 1;
                    const packedWord = decodeTree[treeIndex + 1 + (charIndexInPacked >> 1)];
                    const expectedChar = (packedWord >> ((charIndexInPacked & 1) << 3)) & 0xff;
                    const char = input.charCodeAt(offset);
                    if (char !== expectedChar) {
                        this.runConsumed = 0;
                        return this.flushAndEmitLegacyOrReject(consumed, excess, char, 0);
                    }
                    offset += 1;
                    excess += 1;
                    runConsumed += 1;
                }
                this.runConsumed = 0;
                treeIndex += 1 + (runLength >> 1);
                current = decodeTree[treeIndex];
                // Loop top handles the landed-on node (record/emit/branch).
                continue;
            }
            // Header plus out-of-line value words; 0 means no value.
            const valueLength = current >>> 14;
            const char = input.charCodeAt(offset);
            if (valueLength !== 0) {
                // Record a legacy match (FLAG13 clear = semicolon optional).
                if (!isStrict && (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13) === 0) {
                    this.result = treeIndex;
                    consumed += excess - 1;
                    excess = 1;
                }
                /*
                 * Implicit semicolon handling: emit immediately. Covers both
                 * strict (FLAG13 set) and legacy entities — neither stores
                 * an explicit `;` branch in the trie.
                 */
                if (char === CharCodes.SEMI) {
                    return this.emitNamedEntityData(treeIndex, valueLength, consumed + excess);
                }
                /*
                 * `valueLength === 1` packs the codepoint into the header
                 * word's low 13 bits, where branch metadata also lives. Skip
                 * the branch lookup on leaves so those value bits aren't
                 * reinterpreted as branch offsets.
                 */
                if (valueLength === 1) {
                    return this.flushAndEmitLegacyOrReject(consumed, excess, char, valueLength);
                }
            }
            // Value-bearing or dictionary node: dispatch through determineBranch.
            const next = determineBranch(decodeTree, current, treeIndex + (valueLength || 1), char);
            if (next < 0) {
                return this.flushAndEmitLegacyOrReject(consumed, excess, char, valueLength);
            }
            treeIndex = next;
            current = decodeTree[treeIndex];
            offset += 1;
            excess += 1;
        }
        /*
         * Chunk exhausted. Record a legacy match we may be sitting on, so a
         * subsequent `end()` emits it, then persist the walk state.
         */
        if (!isStrict &&
            current >>> 14 !== 0 &&
            (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13) === 0) {
            this.result = treeIndex;
            consumed += excess - 1;
            excess = 1;
        }
        this.treeIndex = treeIndex;
        this.excess = excess;
        this.consumed = consumed;
        return -1;
    }
    /**
     * Emit a named entity that was not terminated with a semicolon.
     * @returns The number of characters consumed.
     */
    emitNotTerminatedNamedEntity() {
        const { result, decodeTree } = this;
        const valueLength = decodeTree[result] >>> 14;
        this.emitNamedEntityData(result, valueLength, this.consumed);
        this.errors?.missingSemicolonAfterCharacterReference();
        return this.consumed;
    }
    /**
     * Emit a named entity.
     * @param result The index of the entity in the decode tree.
     * @param valueLength Encoded value length (header plus any value words).
     * @param consumed The number of characters consumed.
     * @returns The number of characters consumed.
     */
    emitNamedEntityData(result, valueLength, consumed) {
        const { decodeTree } = this;
        this.emitCodePoint(valueLength === 1
            ? decodeTree[result] & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.VALUE_MASK
            : decodeTree[result + 1], consumed);
        if (valueLength === 3) {
            // Emit the second UTF-16 code unit.
            this.emitCodePoint(decodeTree[result + 2], consumed);
        }
        return consumed;
    }
    /**
     * Signal to the parser that the end of the input was reached.
     *
     * Remaining data will be emitted and relevant errors will be produced.
     * @returns The number of characters consumed.
     */
    end() {
        switch (this.state) {
            case EntityDecoderState.NamedEntity: {
                // Emit a named entity if we have one.
                return this.result !== 0 &&
                    (this.decodeMode !== DecodingMode.Attribute ||
                        this.result === this.treeIndex)
                    ? this.emitNotTerminatedNamedEntity()
                    : 0;
            }
            // Otherwise, emit a numeric entity if we have one.
            case EntityDecoderState.NumericDecimal: {
                return this.emitNumericEntity(0, 2);
            }
            case EntityDecoderState.NumericHex: {
                return this.emitNumericEntity(0, 3);
            }
            case EntityDecoderState.NumericStart: {
                this.errors?.absenceOfDigitsInNumericCharacterReference(this.consumed);
                return 0;
            }
            default: {
                // EntityStart or unknown — return 0.
                return 0;
            }
        }
    }
}
/**
 * Determines the branch of the current node that is taken given the current
 * character. This function is used to traverse the trie.
 *
 * See `BinTrieFlags` for the branch-data layouts handled here.
 * @param decodeTree The trie.
 * @param current The current node's header word.
 * @param nodeIndex Index of the node's first branch-data word (the header
 *   plus any value words have been skipped by the caller).
 * @param char The current character.
 * @returns The index of the next node, or -1 if no branch is taken.
 */
function determineBranch(decodeTree, current, nodeIndex, char) {
    const branchCount = (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.BRANCH_LENGTH) >> 7;
    const jumpOffset = current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.JUMP_TABLE;
    // Case 1: Single branch or jump table (jumpOffset encodes the first/only char code).
    if (jumpOffset) {
        if (branchCount === 0) {
            // Single branch encoded inline in the jump offset bits.
            return char === jumpOffset ? nodeIndex : -1;
        }
        /*
         * Jump table: branchCount consecutive slots starting at jumpOffset.
         * Unsigned comparison handles both < 0 and >= branchCount in one check.
         */
        const slot = char - jumpOffset;
        if (slot >>> 0 >= branchCount)
            return -1;
        const stored = decodeTree[nodeIndex + slot];
        /*
         * 0 = empty slot (no branch); otherwise the child's offset from the
         * end of the branch array, +1 (end-relative pointers compress
         * better). `& 0xff_ff` mirrors the encoder's uint16 wrap for
         * backreferences to already-encoded nodes.
         */
        return stored === 0
            ? -1
            : (nodeIndex + branchCount + stored - 1) & 0xff_ff;
    }
    /*
     * Case 2: Packed dictionary. Linear scan — over 90% of dict nodes have
     * <= 4 branches in the HTML trie, where the constant-factor savings
     * dominate over binary search's asymptotic edge.
     */
    if (branchCount === 0)
        return -1;
    const packedKeySlots = (branchCount + 1) >> 1;
    const branchEnd = nodeIndex + packedKeySlots + branchCount;
    for (let index = 0; index < branchCount; index++) {
        const packed = decodeTree[nodeIndex + (index >> 1)];
        const key = (packed >> ((index & 1) << 3)) & 0xff;
        if (key === char) {
            const pointerIndex = nodeIndex + packedKeySlots + index;
            // Pointers are relative to the end of the branch data.
            return (branchEnd + decodeTree[pointerIndex]) & 0xff_ff;
        }
        // Keys are sorted; if we've passed `char`, no match is possible.
        if (key > char)
            return -1;
    }
    return -1;
}
/**
 * Read the decoded value from a trie node.
 * @param decodeTree The trie.
 * @param nodeIndex The index of the node.
 * @param valueLength The length of the value (1, 2, or 3).
 * @returns The decoded string.
 */
function readTrieValue(decodeTree, nodeIndex, valueLength) {
    if (valueLength === 1) {
        return String.fromCharCode(decodeTree[nodeIndex] & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.VALUE_MASK);
    }
    if (valueLength === 2) {
        return String.fromCharCode(decodeTree[nodeIndex + 1]);
    }
    return String.fromCharCode(decodeTree[nodeIndex + 1], decodeTree[nodeIndex + 2]);
}
/**
 * Parse a numeric entity (`&#DDD;` or `&#xHHH;`).
 *
 * Encodes the result as `(consumed << CONSUMED_SHIFT) | codepoint` (see
 * the packing comment at the top of the file; overlong entities spill
 * their length into `longNumericConsumed`). Returns 0 when no digits were
 * found.
 *
 * This is the sync counterpart of the streaming
 * `EntityDecoder#stateNumericDecimal` / `#stateNumericHex`. Digit parsing
 * matches those methods; only this packed result needs a value clamp.
 * @param input       The input string.
 * @param numberStart Index of the `#` character.
 * @param inputLength Cached `input.length`.
 */
function parseNumericEntity(input, numberStart, inputLength) {
    let offset = numberStart + 1; // Skip "#"
    let cp = 0;
    let digitStart = offset;
    /*
     * Separate decimal and hexadecimal loops: each multiplies by a constant
     * and runs a single digit test, instead of a per-character base check.
     */
    if (offset < inputLength &&
        (input.charCodeAt(offset) | TO_LOWER_BIT) === CharCodes.LOWER_X) {
        offset += 1;
        digitStart = offset;
        while (offset < inputLength) {
            const char = input.charCodeAt(offset);
            if (isNumber(char)) {
                cp = cp * 16 + (char - CharCodes.ZERO);
            }
            else if (isHexadecimalCharacter(char)) {
                cp = cp * 16 + ((char | TO_LOWER_BIT) - CharCodes.LOWER_A + 10);
            }
            else {
                break;
            }
            offset += 1;
        }
    }
    else {
        while (offset < inputLength) {
            const digit = input.charCodeAt(offset) - CharCodes.ZERO;
            if (digit >>> 0 > 9)
                break;
            cp = cp * 10 + digit;
            offset += 1;
        }
    }
    if (offset === digitStart)
        return 0;
    // Include the semicolon in consumed when present.
    if (offset < inputLength && input.charCodeAt(offset) === CharCodes.SEMI) {
        offset += 1;
    }
    /*
     * Clamp out-of-range values to 0x110000 so they fit the 21-bit field
     * and decode to U+FFFD. Lengths at or above CONSUMED_OVERFLOW use the
     * side channel described with the packing constants.
     */
    if (cp > 0x10_ff_ff)
        cp = 0x11_00_00;
    let consumed = offset - numberStart;
    if (consumed >= CONSUMED_OVERFLOW) {
        // eslint-disable-next-line unicorn/no-top-level-assignment-in-function -- deliberate side channel, see `longNumericConsumed`
        longNumericConsumed = consumed;
        consumed = CONSUMED_OVERFLOW;
    }
    return (consumed << CONSUMED_SHIFT) | cp;
}
/**
 * Decode all entities in `input` using the HTML trie.
 *
 * Hard-wired to `htmlDecodeTree`: the inline root navigation below assumes
 * the HTML root's jump-table shape, so this must not be generalized to
 * other tries (the XML trie's dictionary root would silently match no
 * entities — `decodeXML` has its own hand-coded fast path instead).
 * @param input      The string to decode.
 * @param isStrict Only match semicolon-terminated entities.
 * @param isAttribute Whether to apply attribute-specific parsing rules (disallowing certain non-semicolon terminators).
 * @returns The decoded string.
 */
function decodeWithTrie(input, isStrict, isAttribute) {
    const decodeTree = _generated_decode_data_html_js__WEBPACK_IMPORTED_MODULE_1__.htmlDecodeTree;
    // Fast path: no entities at all — return input without any allocation.
    let offset = input.indexOf("&");
    if (offset < 0)
        return input;
    const inputLength = input.length;
    /*
     * `chunkStart` marks the start of the next pending slice. Rejected
     * entities don't advance it, so consecutive rejections are stitched
     * into a single `slice` once a real match (or end of input) is hit.
     */
    let chunkStart = 0;
    let result = "";
    /*
     * Root navigation fields, hoisted out of the per-entity loop. The HTML
     * root is a multi-branch jump-table covering [A-Za-z]; see the inline
     * first-iteration comment below.
     */
    const root = decodeTree[0];
    const rootJumpOffset = root & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.JUMP_TABLE;
    const rootBranchCount = (root & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.BRANCH_LENGTH) >> 7;
    do {
        const entityStart = offset + 1;
        // Quick check: entity names must start with [A-Za-z], numeric with #.
        const firstChar = input.charCodeAt(entityStart);
        let consumed;
        let value;
        if (firstChar === CharCodes.NUM) {
            const packed = parseNumericEntity(input, entityStart, inputLength);
            consumed = unpackConsumed(packed);
            // In strict mode, require semicolon termination.
            if (isStrict &&
                consumed > 0 &&
                input.charCodeAt(entityStart + consumed - 1) !== CharCodes.SEMI) {
                consumed = 0;
            }
            value =
                consumed === 0
                    ? ""
                    : (0,_decode_codepoint_js__WEBPACK_IMPORTED_MODULE_0__.codePointToString)(packed & CODE_POINT_MASK);
        }
        else if (isAlpha(firstChar)) {
            consumed = 0;
            value = "";
            /*
             * The generator guarantees a jump-table root. Consume the first
             * character directly, then walk from its child.
             */
            const rootSlotIndex = firstChar - rootJumpOffset;
            let nodeIndex;
            if (rootSlotIndex >>> 0 < rootBranchCount) {
                const stored = decodeTree[1 + rootSlotIndex];
                nodeIndex =
                    stored === 0 ? -1 : (rootBranchCount + stored) & 0xff_ff;
            }
            else {
                nodeIndex = -1;
            }
            /*
             * Best legacy (no-semicolon) match so far, as trie coordinates.
             * Deferring `readTrieValue` to the end avoids allocating a
             * string for matches that longer matches supersede.
             */
            let bestNodeIndex = 0;
            let bestValueLength = 0;
            let current = nodeIndex < 0 ? 0 : decodeTree[nodeIndex];
            let index = entityStart + 1;
            /*
             * Walk the trie from the root child. The `trie` label lets the
             * inner descent and compact-run loops abandon the entity (and
             * fall through to the legacy/reject handling) directly.
             */
            trie: while (index < inputLength) {
                /*
                 * Inline value-less jump tables and single branches. A miss
                 * falls through to the recorded legacy match or rejection.
                 */
                while (
                // Value-less, non-run node with a nonzero jump offset.
                (current &
                    (_internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.VALUE_LENGTH | _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13)) ===
                    0 &&
                    (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.JUMP_TABLE) !== 0) {
                    const jumpOffset = current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.JUMP_TABLE;
                    const branchCount = (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.BRANCH_LENGTH) >> 7;
                    if (branchCount === 0) {
                        // Single branch encoded inline in the jump offset bits.
                        if (input.charCodeAt(index) !== jumpOffset)
                            break trie;
                        nodeIndex += 1;
                    }
                    else {
                        const slot = input.charCodeAt(index) - jumpOffset;
                        if (slot >>> 0 >= branchCount)
                            break trie;
                        const stored = decodeTree[nodeIndex + 1 + slot];
                        if (stored === 0)
                            break trie;
                        // End-relative: branch data ends at nodeIndex+1+branchCount.
                        nodeIndex =
                            (nodeIndex + branchCount + stored) & 0xff_ff;
                    }
                    current = decodeTree[nodeIndex];
                    index += 1;
                    /*
                     * `charCodeAt` past the end returns NaN, which would
                     * alias to slot 0 after `>>> 0` — bail out explicitly.
                     */
                    if (index >= inputLength)
                        break trie;
                }
                // FLAG13 without a value marks a compact run.
                if ((current &
                    (_internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.VALUE_LENGTH | _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13)) ===
                    _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13) {
                    const runLength = (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.BRANCH_LENGTH) >> 7;
                    // Check first char (stored in JUMP_TABLE bits).
                    if (input.charCodeAt(index) !==
                        (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.JUMP_TABLE)) {
                        // eslint-disable-next-line unicorn/no-break-in-nested-loop
                        break;
                    }
                    index += 1;
                    // Check remaining characters (packed two per uint16 word).
                    const remaining = runLength - 1;
                    let wordIndex = nodeIndex + 1;
                    let charIndexInPacked = 0;
                    /*
                     * Process pairs: read one packed word, compare low byte then high byte.
                     * No explicit bounds check needed — charCodeAt returns NaN for OOB,
                     * which never equals an integer, so the mismatch break fires naturally.
                     */
                    for (; charIndexInPacked + 1 < remaining; charIndexInPacked += 2) {
                        const packed = decodeTree[wordIndex];
                        if (input.charCodeAt(index) !== (packed & 0xff))
                            break trie;
                        index += 1;
                        if (input.charCodeAt(index) !== ((packed >> 8) & 0xff))
                            break trie;
                        index += 1;
                        wordIndex += 1;
                    }
                    // Handle odd trailing char.
                    if (charIndexInPacked < remaining) {
                        if (input.charCodeAt(index) !==
                            (decodeTree[wordIndex] & 0xff))
                            // eslint-disable-next-line unicorn/no-break-in-nested-loop
                            break;
                        index += 1;
                    }
                    nodeIndex += 1 + (runLength >> 1);
                    current = decodeTree[nodeIndex];
                    // eslint-disable-next-line unicorn/no-break-in-nested-loop
                    continue;
                }
                // Header plus out-of-line value words; 0 means no value.
                const valueLength = current >>> 14;
                const char = input.charCodeAt(index);
                /*
                 * Check current node for a value before navigating.
                 * This handles both: (a) values reached via compact runs on the
                 * previous iteration, and (b) values at regular branch targets.
                 */
                if (valueLength !== 0) {
                    // If char is `;`, emit immediately.
                    if (char === CharCodes.SEMI) {
                        consumed = index - entityStart + 1;
                        // Inline leaves carry the value in the low 13 bits.
                        value =
                            valueLength === 1
                                ? String.fromCharCode(current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.VALUE_MASK)
                                : readTrieValue(decodeTree, nodeIndex, valueLength);
                        // eslint-disable-next-line unicorn/no-break-in-nested-loop
                        break;
                    }
                    // Record non-terminated (legacy) match (FLAG13 clear = semicolon optional).
                    if (!isStrict && (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13) === 0) {
                        consumed = index - entityStart;
                        bestNodeIndex = nodeIndex;
                        bestValueLength = valueLength;
                    }
                    /*
                     * A valueLength of 1 means the value is packed inline in the header
                     * word — these are always leaf nodes with no branches, so we can
                     * stop walking the trie.
                     */
                    // eslint-disable-next-line unicorn/no-break-in-nested-loop
                    if (valueLength === 1)
                        break;
                }
                // Navigate to the next node (valueLength || 1: skip past value words, minimum 1 for header).
                const next = determineBranch(decodeTree, current, nodeIndex + (valueLength || 1), char);
                // eslint-disable-next-line unicorn/no-break-in-nested-loop
                if (next < 0)
                    break;
                nodeIndex = next;
                current = decodeTree[nodeIndex];
                index += 1;
            }
            /*
             * Post-loop: if the semicolon path didn't set value,
             * check for a final legacy match. The last navigation may
             * have landed on a legacy node whose value hasn't been
             * recorded yet (loop exited before the top-of-loop check
             * could run).
             */
            if (value === "") {
                const finalVL = current >>> 14;
                if (finalVL !== 0 &&
                    !isStrict &&
                    (current & _internal_bin_trie_flags_js__WEBPACK_IMPORTED_MODULE_3__.BinTrieFlags.FLAG13) === 0) {
                    consumed = index - entityStart;
                    bestNodeIndex = nodeIndex;
                    bestValueLength = finalVL;
                }
                if (consumed > 0) {
                    value = readTrieValue(decodeTree, bestNodeIndex, bestValueLength);
                }
            }
        }
        else {
            consumed = 0;
            value = "";
        }
        /*
         * The attribute end-char rule (HTML spec §13.2.5.73) only applies to
         * unterminated *named* references.  Semicolon-terminated entities and
         * numeric entities are always accepted, matching EntityDecoder behavior.
         *
         * When `attribute` is false (the common case), short-circuit skips all
         * the unterminated-named checks entirely.
         */
        if (consumed === 0 ||
            (isAttribute &&
                firstChar !== CharCodes.NUM &&
                input.charCodeAt(entityStart + consumed - 1) !==
                    CharCodes.SEMI &&
                entityStart + consumed < inputLength &&
                isEntityInAttributeInvalidEnd(input.charCodeAt(entityStart + consumed)))) {
            // Rejected: leave `&` in the pending chunk, scan past it.
            offset = entityStart;
        }
        else {
            if (chunkStart < offset) {
                result += input.slice(chunkStart, offset);
            }
            result += value;
            offset = chunkStart = entityStart + consumed;
        }
        /*
         * Adjacent entities (`&x;&y;`) are common in entity-dense input;
         * checking the single character at `offset` first skips the
         * `indexOf` call (and its per-call overhead) for that case.
         */
        if (input.charCodeAt(offset) !== CharCodes.AMP) {
            offset = input.indexOf("&", offset);
        }
    } while (offset >= 0);
    return result + input.slice(chunkStart);
}
/**
 * Decodes an HTML string.
 * @param htmlString The string to decode.
 * @param mode The decoding mode.
 * @returns The decoded string.
 */
function decodeHTML(htmlString, mode = DecodingMode.Legacy) {
    return decodeWithTrie(htmlString, mode === DecodingMode.Strict, mode === DecodingMode.Attribute);
}
/**
 * Decodes an HTML string in an attribute.
 * @param htmlAttribute The string to decode.
 * @returns The decoded string.
 */
function decodeHTMLAttribute(htmlAttribute) {
    return decodeWithTrie(htmlAttribute, false, true);
}
/**
 * Decodes an HTML string, requiring all entities to be terminated by a semicolon.
 * @param htmlString The string to decode.
 * @returns The decoded string.
 */
function decodeHTMLStrict(htmlString) {
    return decodeWithTrie(htmlString, true, false);
}
/**
 * Decodes an XML string, requiring all entities to be terminated by a semicolon.
 *
 * Uses a hand-coded fast path for the 5 XML named entities (amp, lt, gt,
 * quot, apos) plus numeric entities, bypassing the trie entirely.
 * @param xmlString The string to decode.
 * @returns The decoded string.
 */
function decodeXML(xmlString) {
    let offset = xmlString.indexOf("&");
    if (offset < 0)
        return xmlString;
    let lastIndex = 0;
    let result = "";
    do {
        const start = offset + 1;
        let consumed = 0;
        let value = "";
        const c1 = xmlString.charCodeAt(start);
        if (c1 === CharCodes.NUM) {
            const packed = parseNumericEntity(xmlString, start, xmlString.length);
            consumed = unpackConsumed(packed);
            // XML is always strict — require semicolon.
            if (consumed === 0 ||
                xmlString.charCodeAt(start + consumed - 1) !== CharCodes.SEMI) {
                consumed = 0;
            }
            else {
                const codePoint = packed & CODE_POINT_MASK;
                // Nonzero BMP values below the surrogate range need no replacement.
                value =
                    (codePoint - 1) >>> 0 < 0xd7_ff
                        ? String.fromCharCode(codePoint)
                        : String.fromCodePoint((0,_decode_codepoint_js__WEBPACK_IMPORTED_MODULE_0__.replaceCodePointXML)(codePoint));
            }
        }
        else {
            /* eslint-disable unicorn/no-break-in-nested-loop -- Keep XML name dispatch inline with the decode loop. */
            switch (c1) {
                // &lt; / &gt;
                case 0x6c:
                case 0x67: {
                    if (xmlString.charCodeAt(start + 1) === 0x74 &&
                        xmlString.charCodeAt(start + 2) === CharCodes.SEMI) {
                        consumed = 3;
                        value = c1 === 0x6c ? "<" : ">";
                    }
                    break;
                }
                // &amp; / &apos;
                case 0x61: {
                    const c2 = xmlString.charCodeAt(start + 1);
                    if (c2 === 0x6d &&
                        xmlString.charCodeAt(start + 2) === 0x70 &&
                        xmlString.charCodeAt(start + 3) === CharCodes.SEMI) {
                        consumed = 4;
                        value = "&";
                    }
                    else if (c2 === 0x70 &&
                        xmlString.charCodeAt(start + 2) === 0x6f &&
                        xmlString.charCodeAt(start + 3) === 0x73 &&
                        xmlString.charCodeAt(start + 4) === CharCodes.SEMI) {
                        consumed = 5;
                        value = "'";
                    }
                    break;
                }
                // &quot;
                case 0x71: {
                    if (xmlString.charCodeAt(start + 1) === 0x75 &&
                        xmlString.charCodeAt(start + 2) === 0x6f &&
                        xmlString.charCodeAt(start + 3) === 0x74 &&
                        xmlString.charCodeAt(start + 4) === CharCodes.SEMI) {
                        consumed = 5;
                        value = '"';
                    }
                    break;
                }
            }
            /* eslint-enable unicorn/no-break-in-nested-loop */
        }
        if (consumed > 0) {
            if (lastIndex < offset)
                result += xmlString.slice(lastIndex, offset);
            result += value;
            offset = lastIndex = start + consumed;
        }
        else {
            offset = start;
        }
        /*
         * Adjacent entities (`&x;&y;`) are common in entity-dense input;
         * checking the single character at `lastIndex` first skips the
         * `indexOf` call (and its per-call overhead) for that case.
         */
        offset =
            xmlString.charCodeAt(offset) === CharCodes.AMP
                ? offset
                : xmlString.indexOf("&", offset);
    } while (offset >= 0);
    return result + xmlString.slice(lastIndex);
}

// Re-export for use by eg. htmlparser2


//# sourceMappingURL=decode.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/entities/dist/escape.js"
/*!*************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/entities/dist/escape.js ***!
  \*************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   XML_BITSET_VALUE: () => (/* binding */ XML_BITSET_VALUE),
/* harmony export */   encodeXML: () => (/* binding */ encodeXML),
/* harmony export */   escape: () => (/* binding */ escape),
/* harmony export */   escapeAttribute: () => (/* binding */ escapeAttribute),
/* harmony export */   escapeText: () => (/* binding */ escapeText),
/* harmony export */   escapeUTF8: () => (/* binding */ escapeUTF8),
/* harmony export */   getCodePoint: () => (/* binding */ getCodePoint),
/* harmony export */   xmlEncodeRegex: () => (/* binding */ xmlEncodeRegex)
/* harmony export */ });
/**
 * Get the named reference for an XML special character or U+00A0.
 * @param char Code unit matched by one of the escape regexes.
 */
function getEscape(char) {
    return char === 34
        ? "&quot;"
        : char === 38
            ? "&amp;"
            : char === 39
                ? "&apos;"
                : char === 60
                    ? "&lt;"
                    : char === 62
                        ? "&gt;"
                        : "&nbsp;";
}
/**
 * Read a code point at a given index.
 * @param input String to read the code point from.
 * @param index Current read position in the input string.
 * @returns The code point at `index`, or `undefined` if `index` is out of range.
 * @deprecated Use `String.prototype.codePointAt` directly instead; this export
 *   will be removed in the next major.
 */
const getCodePoint = (input, index) => input.codePointAt(index);
/**
 * Bitset for ASCII characters that need to be escaped in XML.
 */
const XML_BITSET_VALUE = 0x50_00_00_c4; // 32..63 -> 34 ("),38 (&),39 ('),60 (<),62 (>)
/**
 * Matches exactly the characters `encodeXML` escapes: the five XML special
 * characters plus every non-ASCII code unit (lone surrogates included — no
 * `u` flag). Kept in sync with `XML_BITSET_VALUE`.
 *
 * Shared with `encodeNonAsciiHTML` in `encode.ts`. Because the regex is
 * stateful (`g` flag), every call site must set `lastIndex` before use.
 */
// eslint-disable-next-line unicorn/prefer-unicode-code-point-escapes -- the `\u{...}` form requires the `u` flag, which we deliberately omit so lone surrogates match by code unit
const xmlEncodeRegex = /["&'<>\u0080-\uFFFF]/g;
/**
 * Whether `code` (a UTF-16 code unit) is escaped by {@link encodeXML}: a
 * non-ASCII unit, or one of the five XML specials flagged in
 * `XML_BITSET_VALUE` (which is only meaningful for code units 32-63).
 * @param code Code unit to test.
 */
function isXmlEscapable(code) {
    return (code >= 0x80 ||
        (code >= 32 && code < 64 && ((XML_BITSET_VALUE >>> code) & 1) === 1));
}
/**
 * Encodes all non-ASCII characters, as well as characters not valid in XML
 * documents using XML entities.
 *
 * If a character has no equivalent entity, a numeric hexadecimal reference
 * (eg. `&#xfc;`) will be used.
 * @param input Input string to encode.
 */
function encodeXML(input) {
    const { length } = input;
    let out;
    let last = 0;
    let index = 0;
    while (index < length) {
        const char = input.charCodeAt(index);
        /*
         * Find the next character to escape: scan a short window inline
         * (escapable characters cluster in markup-heavy input), then fall
         * back to the regex, which skips clean spans in native code.
         */
        if (!isXmlEscapable(char)) {
            const bound = Math.min(index + 32, length);
            let next = index + 1;
            while (next < bound && !isXmlEscapable(input.charCodeAt(next))) {
                next++;
            }
            if (next < bound) {
                index = next;
                continue;
            }
            if (next >= length)
                break;
            xmlEncodeRegex.lastIndex = next;
            if (!xmlEncodeRegex.test(input))
                break;
            index = xmlEncodeRegex.lastIndex - 1;
            continue;
        }
        if (out === undefined)
            out = input.substring(0, index);
        else if (last !== index)
            out += input.substring(last, index);
        if (char < 64) {
            // Known replacement
            out += getEscape(char);
            last = index += 1;
            continue;
        }
        // Non-ASCII: encode as numeric entity (handle surrogate pair)
        const cp = input.codePointAt(index);
        out += `&#x${cp.toString(16)};`;
        if (cp !== char)
            index++; // Skip trailing surrogate
        last = index += 1;
    }
    if (out === undefined)
        return input;
    if (last < length)
        out += input.substr(last);
    return out;
}
/**
 * Encodes all non-ASCII characters, as well as characters not valid in XML
 * documents using numeric hexadecimal reference (eg. `&#xfc;`).
 *
 * Have a look at `escapeUTF8` if you want a more concise output at the expense
 * of reduced transportability.
 * @param data String to escape.
 */
const escape = encodeXML;
/**
 * Escape `data` using `re`, mapping each matched character to its entity.
 * Every match is one UTF-16 code unit, so its index is `lastIndex - 1`.
 * @param re Global regex matching exactly the characters to escape
 *   (`"`, `&`, `'`, `<`, `>`, `\u00A0` at most).
 * @param data String to escape.
 */
function escapeWithRegex(re, data) {
    re.lastIndex = 0;
    if (!re.test(data))
        return data;
    let out = "";
    let last = 0;
    do {
        const index = re.lastIndex - 1;
        if (last !== index)
            out += data.substring(last, index);
        const char = data.charCodeAt(index);
        out += getEscape(char);
        last = index + 1;
    } while (re.test(data));
    return out + data.substring(last);
}
const xmlEscapeRegex = /["&'<>]/g;
/**
 * Encodes all characters not valid in XML documents using XML entities.
 *
 * Note that the output will be character-set dependent.
 * @param data String to escape.
 */
function escapeUTF8(data) {
    return escapeWithRegex(xmlEscapeRegex, data);
}
const attributeEscapeRegex = /["&\u{A0}]/gu;
/**
 * Encodes all characters that have to be escaped in HTML attributes,
 * following {@link https://html.spec.whatwg.org/multipage/parsing.html#escapingString}.
 * @param data String to escape.
 */
function escapeAttribute(data) {
    return escapeWithRegex(attributeEscapeRegex, data);
}
const textEscapeRegex = /[&<>\u{A0}]/gu;
/**
 * Encodes all characters that have to be escaped in HTML text,
 * following {@link https://html.spec.whatwg.org/multipage/parsing.html#escapingString}.
 * @param data String to escape.
 */
function escapeText(data) {
    return escapeWithRegex(textEscapeRegex, data);
}
//# sourceMappingURL=escape.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/entities/dist/generated/decode-data-html.js"
/*!*********************************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/entities/dist/generated/decode-data-html.js ***!
  \*********************************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   htmlDecodeTree: () => (/* binding */ htmlDecodeTree)
/* harmony export */ });
/* harmony import */ var _internal_decode_shared_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../internal/decode-shared.js */ "./node_modules/sanitize-html/node_modules/entities/dist/internal/decode-shared.js");
// Generated using scripts/write-decode-map.ts

/** Packed HTML decode trie data. */
const htmlDecodeTree = /* #__PURE__ */ (0,_internal_decode_shared_js__WEBPACK_IMPORTED_MODULE_0__.decodeTrieDict)("!}.&u%}'&}*'~!6*)%&,~!J~!J~%L~y<~!R,~~%Lu~~#GD~~#|)1#%}^%}2%+#.##%##%}&%##%'#%##&%#%#'%#&#%#&#'#%%#&#%##%#)%''%&%#%#'%#%%#%%}%%%#%#&(23#%%#&-%0%('1#(##%#'##+%'*.:1}#%#6-+(%'%%#%%%}#L'2351&('%}&/N'(0(/*-%(%%}#'+&T%7.2}#&%&#%#36/5##%&%%#&#%%#))2%%##%&&'0~!#*+&'%1~!%).'3q?&%'1~!.##%6(~!+%%%(Gw'rT~!E#<nA%#jZ~!H%(~!42##~!*31&~!G%U~#)5~#`3~!J~!Z~%]~%Y~%C~!q~!u~#kz~%#~!6'~!D~!U~!?~#T~!c%~!G#'~%7|~!G~!J~!G&~#pb~(Df}#%}*&}#%##%##%##&#-}&'#'&%#.++}%mI,#,@&(}*%}*'%&##&#%##%}&0}#.},U},%}+%}&%}#%##&}B%(}(%}+%)})%##%#&}&%##%&}<%}>%#%&}*%}(%}9%}/%})%}*%}*%}?&}&%}3%}&*#%})%#%#)}#&#-#+*%E%%'%'#%}#*V##&##I}#&&##%&%#&&Qf%%))w/0+&%#(#.%-''''++++7}>%4'',##1,#%#&%##&#'##&#*#9)%&%}#*}%,#+P(%A&%#'&##wSD',9E00#y#@}(+}&%&>~!#~!X}#*}(&&}(&}(,%}%&#+&}#&}I%#%}%)#(},'%#*}4%%#%}(''}#/##(##),%-##%%)#&}(.}&%#&}%%}*&#%},&&}&%}#%*'#%})%}D&}&%}-&}6&#&}-,%}#%})-(~+`~,=?~I9'9%~!,#%})%})%}@%}?%}(~!?~#<~#pP~#BG~#=1#%K+~#?#~%;)~#A~#mF1~#A'~'X%'~#lR~#N~'N~#r~#m#-~#i'?%#'%~#B%##%,%#~#_%#0%~#]732~,w~2+#:&#%&'0%&>%}#>##F+)#%&&#(+_}4&}-%}(&}@&}O7Fdf0@+/v4}&WU##&/0#&'('B#%}.%}'+#%}#%%&#&%#%##+#&#)#6#'#.},%}c%},%#%##%&#&%#&~#>'*-.%##%##%}#%%}%'~#)D1}#%*&~#_%%'(~#S2%'.}#~#=##*'*-%}&'%'##&&~'E%.#&~#M4}%%##&'%#~#O1##%&#'+~#<B%##%%'%+~#;#@%}#&%#&&%#(~#H1}'%'##&&~#?A}&'~#D#%32}'&&&&~#[}'(#%}'~#;C})&}%%#%~#=&%,3}%'(#%%~#^'#&&)#%'~#Y%-~#d-%'~#^%%&#&&&}#~#b~2t*&'~&(~&@~0%~e~3}%*''0})&}+~!9##-}#%-hD*)1fC#%/&/fB#40~!+#)*4~!+~!K'&:~!/*7~!.#~!H~!L':~%x&~!H#~!*~%1~!I#~!+A~#p'~!F~~#-#~,,(~.Z~!V~%;'B'mq-W~!N~%I%#&&#&}#%},%%}'%}+X#%}#&}(%}'%}<%}#%}%%'}'%}:~![)9@~%>~#UA%-%##&~!C%~!-.9:~!1~!-^2/:a~!y,D*J#-5)/4~%23,~#G~!L1~!0X3`~!2+~!!0-~&E~!W~!o,>Y&]~%cZx_&~#O*9#A#'#+I'%#)~!0B*-5A+-((F&*M#)(-7-5+'-3a5Vi~!Y~!?+[)%3),ERHm~!+:D,VG.+)?fB%%*(%)'(#&80%1'8`K8?`+'Z#&O&'H5#*9)A%%5&3))0%39+.*7#()&&*=4@**L)<'_&*+..;(#*+)./&0#3)%')-8(4ixD(&.}%,('aI:,)%,k2231T)I'#/-W7,/'Q#.'Y24+h')37</31&83##&0#),H(?'&?/1##%#&&#%''-%&&&#(&''&#.-'%#%%(,')*'&#&#'##%(%(#%('#&##%%%%('%#%#%%#%#&%##h>w+v<ayvyvcg.uuhKr}g/v|g>u9i[~>g5uI~=RvdwEg;v/g;uk!!TTSx]@RT!U!#!@VBRUU!'UTe-d0c`e&gSdicedFcrdTaqb.kYcAohdYd@a3e+d}dMdtd.aJ#bqcK`dle/e.e'dwdPdodddjbEb}ogd^ofdpduc6j?l%d{drdqc)d7bacOdQ%T#Y)X.sR[yH>6Vyv3[xwLu>vo'!*.[yBacahoj>6Rew3[xqdZa#!a&#^(X-[yG>6Vyu3[xvg3sEr|g.u/Ri9db0T#^(Xa)!-[y;>6Vylg4wKs{JwNZt3@3r=c4Z([xlg;wKt!cpq's@v7A'*a(a+!-a#[y<3Dt?3Dt'>6Vym3[xmg9rxsNJwLZt4~?r?db1T#`-!(Xa,!0[yS>6Vz%NuQs.g4wKtnJwNZtS@3r>c4Z([y%g;wKtrdga8!a(!#&T*Y-Xa#!a0<or[yc3Dtq>6Vz43[y3JwNZtf@3s!Ju}!%Dti:pm3c_%X#tjB5pkd6q!r]u?voC'*-a.a2!0a&a+[yI3DtI3Ds~3DtH>6Vyw3[xx;:s#~<5pKJwNZtE@3r~d`a)!a2T#a.(!+U.X1[yT3Dt`3Dtv>6Vz&3[y&g9rxwzcxstPu.<rAJwLZtT~?r@dZa%!a.&^*Za(/Reu[ya>6Vz23[y1g3sEr}wkg{NuQRg{ci(U#5@b`~,cg#U(2WnH5wugcRh7dX#T(Y,a'Ta!!a,[yZ<]mj>6Vz,3[y+Pv#5ReZKu+=,%!H}7ABwkaS?Rh:BcW(X#<]mrj:ubv/ARekdg%!(!a.*Ta(Y.X1!#sP>Rl*Dt6[y>>6Vyo3Wf*jOvuumvuRgRJuq*!:9<B@bX~3jVv&v@s@5Re[d/rQt{uAvo&a&a*)a2!,0Wf!3Dt0=Bs'>6Re}3[xy~<5s%JwJZt1~Gs)c;&!#2sJkNuXvzq7rxu,Re8dka4!a8(aEZ+a@Y.X1Xa)[yd=Bs(3DtP>6Vz53[y4cX#X&Re:avRe9~<5s&JwJZtQ~Gs*i^rzvdRg+Jv{%!2sbB@bX}kdga,!Za?&^*T1/!a'Dt+[y6>6Vyf3Wf%g/u;s4hGu6?Rh-JvZ,!c%#&RoX54Rivj7uyvf8RgTKvZB%*!2sGh<vu5Rgq<=C::9bb~#dZ#T&Ta6Y.X*Dt>[y93Wf)coZ(T,6VyifluvRgC@95@B@bX~/hFu34cC#T,k/unq8w8Q5RkUklwQuzunq8w8Q5Rk8d/rJu?v8w9)-&!a0a;a&aIWejg3sEr/h1s<DtDJvyZqY5aws3Jvy!&Wei~Hr1:au5@Bag>23E~5c:Z&bX};kKv?w&unuVu5Rjc;>bs)#~@:Rh.=ay<a]C;b`}Vd6s/t{uAvoaxa()!a,a7%-a#a2Dt,[yF2Wo[>6Vyt3[xuNuPRi&NuPwpi#RoWh?vf8Ri%Jv]!%Ri:KvxD!.'2WeAjZu`q9rxu,Re7woeAg-unLq(qA_/*2Wg_g3u5q^9:4E}/jTrxrzv=Wkkd~0UX#^^Xa-a1a5T&a=U1a'*aEa]!a*aPaA-adok[y54Rn>;:p3~Dp5g9rpsFNvZqjg3uJp4~<5p0Pw;5qlJwNZt*@3p1Pw:5p/Ou!5p2JvG'!6Vye=<qnJvh_[xhg3v,Rh3kOwOw-sDuev/Re^dha[a%!%!a+#Ta7)-5TaCaO!aka!a)sf[yb2>Rl!9ARiq5E}Qg=ucRkBE|oJrJ_@Wk~@Wk{JrJ_@Wk|@WkyJrJ_@Wk}@WkzJvO_[y2g-vMRmiKuYC!)&>Ri;>Ri<@3RkNc](X#@9Rk=g5vuRmhKvDB!+'=]meg3u4Rmgd)#Y'Vz3CARmfd`a+!%T'!+#Ta1Ta6TaM-sTDt9[yA9sYd'%Y#s[[xpj:ueunaXRgEjRq,v-vuqdd2'`#6Rev<32@5>:2<E}5xIo9a*X#Y(;5RePJvD_g>vyRgNj8w)v8<wggs:RgXiZt|vjx,hSq3ah!-(~@:Ro/Ou!5RhWj^v(pyw8unRhUdx-UY#^Ua.a3a70!)%UX1TaDa)'omRiRRhE[y:3Dsz=Br,>6Vyj3[xkg6ruwjcqsrPw;5r*Ku]D'Zt-@3r(~?r.i[vwv]dU1a--U#`a4(g/vsRhPOu!5RhLj:rmu9Wo!~@:wdh@g/vsRiTjXuvvNr}:RhBj^v(pyw8unRn]dz1UYa'a+^Y(!aETZalaRY.Ta?a4[yDJw1!#qLsW>6Vyrfzq-pLflpwRe|Js>%!Dt@3Dt&Jvy_[xs~HrnjMuwpsw'RecKu+D#'!t<~Grl~?rjg5u-x,gwp{ah!-(~@:Rg~Ou!5Rh'jXuvvNr}:Rh#cW#X/c;&!#2sLi[v7u7RgpJv)(!iLrxu,Re6j7v@s@5Se[e7d`aW!Za(a`T.a#!a3!&aDa-!9)Dt_=6s+3[x~~DR|h~DS6avhGun5RkZj3w)v-]mkKunB!&*]kb97R|i<ARk<c:Z(6Vy}Juh'!wziMRoS:F|vkLuauJv5vtvQRh1d='T+Y#VyO~DR|jcF#T'7R|g97R|kJv3'!ay<Rj,Jvh&!:ReXcsa6*a+#a#_aIRf9aLRf?c,Z&Rf5Rf7c.Z&Rf;Rf>cQ#%T'p-Rf8Rf=ct#%'(*!,p,Rf4p+Rf6Rf:Rf<d~'Ua%U*^UYa(!a,-!#a4YaTalaEX0a8a<Weo3Dt/3Dsx=Br93Wen~Dr;~<5p<JwNZt2@3p=Pw:5p;Ou!5r3c7&!#:p>3Ds}KvGB)_6Vyk2sM=<r7x'eovA(!hFu1ARf}cV#X&@r5j6rvwQa^Rf3c=Za'wkghJv__g;unRggA53B9=b^}%j6uduo5Jq;!(hIv%2Re`Ou4ARe_e%a#^^^Xa&!a*a2!&a6YaP!*ad!#a:aE/5Rn?[y@>6Vyp;:pE~DrY~<5pBJwNZt8@3pCh=rt3rWPw:5pAJup_[xoNuPpF9c!#'45pD5ARn)d8#X'X*3@rU72s]h>v<<sSjJpqvewOJq/(!hNw'5ReBk0s2u3w/w'5ReE5@Jq.!a+JQ!&WeU23d(#Y&RjG5]jBk!u7w&u0udARjEe#+^^^Ub#!a2/a`Z(agT1!a-a;|@TaG!aS[yV=Re~fow'RguNuPRe?bz#'>RoUWeL>:Cbb|?JwPZtVg6ruRmzJvD'!6Vz(g/vmRh~Jvy_[y(g9voRgyx*cy(#2>Ri2B9b]~9kIw9u7rluJu3Rg]dI#a%UY'@=p%CAx.gQZ&RhwwygtRm{x5g_Z'+ABqR9Woa=Bp&dV#^*Xa'!&@o{g4v]Rk;Jv{!%Rk[wkkiA5RkiwwfUB=x,fUuqC&*!>RfTg8v0RfV~ARfSd;rJsAuAv9wR'ae+/aO!a@aza/a#[yQ@Wg!2Wemg3sEr0JvB_g>uvReWg2v+Re=KupB_+[y!2AbY~-~Hr2AJwD!(h<~El>h<~El?Kun@+_:9b`}Kg-v/Ri3g;vtwyk_9]k_d=&T#*U.6qh@Ab`|K9:H|CJv[!&3Dtex'fDwC%!Rf[9WlMd[(^X,!a%Z06Vz!@WgBg=v~Rgvg,QRe@awd,#Y+jTv|Q~EfWj]uNr|~FRfXdy#Y&^Ua%!aO.!(a)Ua;=!a@aKap!a-,a!Ta]a[rSa]p?[y82sK=Bq~;:p:~<5p8Pw:5p7d'#Y'Wf(;RnRi[u4w&RgJJvG'!6Vyh=<r#ijuuv/sIKuYD'ZtG@3p9~Gr&d2#`(g<vtRgFj`u5w&rqpxRf2CJuY!+:wfnTOu!5Rg}jNs1ucv&RfwJvA!&3@q|BDcC#T,k/unq8w8Q5RkTklwQuzunq8w8Q5Rk9dga#!a'!a=#a0!:+Tb*b@aO.a4!aba8aFJv^}?!VyR~Dr<g;u%Rn.~<5p[x'e`wNZtR@3p]Pw:5pZhNvjBp.woe_g5u-r4JwF!%DtO3:ooc7&!#:p^3DtpLuGw(!+%)Dtk6Vz#2sd=<r8d'#Y([y#<x3gJt`w@!)%}MRiowzikRij=]ilxAf3,U(#B2Rf#g0v-Rm[ck{`U#]giKv3>)!&6Ri154s,KuGB_%@r68r:dJ|t`#X(9<E|u2@H|rx3gJu?w'!+'1Nu7Reg4=H~+9<wxgY95Rm]xLggZ-`(X}U2:Ri4h<uOawRmsJv__5@bb{jbV~3dka#a'a]!,#a+U=a>b6a3b%!/aKa/)!arwve^VyJ;:pR~DpTg3uJpS~<5pOPw;5qmPw:5pNOu!5pQJvG'!6Vyx=<qoJvA!{~Jup!%@qk7Rn/KvyD!}''[xz;>wkh'?Rh,x8gyt`w5D!&),(SgyccRgztJ@3pPB5p#d'(Y#<]mmifubw&RgoJvE&!82s^JvF&!8Rf,ADb]~;x=h'rNu]vK!,%'*0RnORh)4Rh*AqQg-vaRnNg;wHwkh'ba~4cE#Ta*x3gctyw@'!+%RnFRnD<4Rn@hFvK5RnCxWg[#`&a0Ua()`1Rm75Rg[c]%X#qi8Rg^NvdRj>BwzgZauwji7Rm6A4wgg]d1#&(*,.0a#Rm;Rm<Rm=Rm>Rm?Rm@RmARmBe%#^^^Xaea?aC/b+(,!a+a#!a/!>a&Ta<aKbD!2wphBRnk[yPw}hE|.=Br-3Dtm>6Vy~g6urRf.x,hPrNav!%'RnqRo%Ro#Nu;q[Pw;5r+JwNZtM@3r)d'#Y'Weh;xChL#`&RnmRnoKu}>%(!Rne~Bs-;2wjcussJv+'!aYSO}6@B<5?ba~8LrNvj!.%*ROwungw~ng~:9;Ri^>wtnig;wHRnixDh@|(UZ.x1h@|)!#:2<H|*xHn]#-UX'3Ro)z=iT}6ARns=Bwsn_wpnaRncw]aR(#UXa&Ua*a/=]iPd'#Y&Ro'WnXf{QRm2hNvj]nZd`'T~&1`{|`#9b]{}c:'!#Wl{>@=be}]?cl{{U#:5Abb}Jds#^YaF!a*b4a#a3aPa>&Tb!bH!*a_!Eau?/a&RjY<]gj>6Vz*;:pe~DrZg,QRj1JwNZtX@wihspcJvZ&!VyX9WmOJu|!|N2WmHJvh&!]ht~Bpbcn&T(!#RmQ<s7Nu;padH#X'`+WmJ@>RmKCARhnKup=!)&Wf+:RhqNuPpf9c!#'45pd5AwghpARn(Ls@w!%,)!RmP@Wfe<E|IJva!&WmNg8vsRmLd`*.`#Y'Xa!axRn*]hrA8Rhug5s@rXg8u!RmMd8#X'X*3@rV72smdI*#UY&RmICARho~GsgxVgd)Ta'U-Y&Xa!T#RnEWnA@Wffg1uDRi0hFvK5RnBxGnG&#`%owp)@wsf+bX}Ze-*1!a*^^^Ua|!#a.aq&Ya2!a>.a6!a:aO`aJDtL[y`@Wg#>6Vz12@wzoYRoZNuPRi!NuPRhzg=ucRi,@=b`{Yg=ucRi-ACJvB!&Sh[ebSh]ebi`wUuFRm4Jw2_[y0JvB!.<Ju(!&SoG}6Shd}6<Ju(!&SoH}6She}6Kur@._g5vHRieJvx!{L2G{Kx6gd'T#?Rh82Wi5cZ#X(g1w)Rm5dW-Y(Ta#!a)!#aYa=wnfE=su2>>bU{0j9udv:<svj8uQv-7RgHdE%#^'sq9sp=>Bb_{TJv`!&g/r|snj6v(us5d,#Y(56H}[978H}]Jw5!&g1rushJvB!+j;v{u5?zDhd}6}bj;v{u5?zDhe}6}ce*#`(^^^a[aea!=!a6a*aoXb1a.!aAbL!b>,b'aL!aV@Wf|2Wlg3[y/JwNZt^@3piPw:5pgJunZou3@rsJva&!Vy_g<v~Rm#JvG'!6Vz0=<r{Ju{%!:pj@WfsiXuJu3Rm:JvZ&!WfA~Bph@c4Z&Dtwax5rubx(#:awRk1@d,#Y&RfjRfid1#,Y(@Wfp2Wlrg5s@ryKu[@!,'=]ig9wlk?Rk>g5u-rqJvy'!@9RkQcH(T#=>Ri~@<wkj(Wj(KuZB*!&<7rw@9RkRcH(T#=>Ri}@<wkj)Wj)dg(Ta2Xa9X#`-!a*CARhg@@=I}d9x;c~#X%so=<sj>2@@=aybb}XjWv0Q~EfEj3vLv;<d,#Y(56H}`978H}_dgaPaFa'a/!#a3Y0a_a;a|!1(a7-[yE3[xt;:pJNvZrrg3uJrvJwNZt=@3pIh=rt3rxPw:5pGOu!5rpJvG'!6Vys=<rz@c4Z&Dt(ax5rtJvZ!&~BpH@wsfNg-vaRlNci*U#=<wei<F}a5@Jq.!a*JQ!%@qZ23d(#Y&RjH5]jCk!u7w&u0udARjFd/prq=tyvpaEa(a:.!a1aZ(@@=I}:9wpd%=<sX55w_h}@@=I{t=ay<aU@@=I}T=ay<2@@=I})?C9:9au@9Cb]}DP~=x-fAZ(2Wl1=ay<aU@@=I}>5@d##Y+jTv|vV~EfFj]uNpn~FRfGdgaK!Z2&!a8a-Tb({E!acTbM*!a(DtY[yYd'%Y#sl[y*hHvh>Re5x2c{Z}.j4uCvcawRiMd+#X+_x&d!},<5RkX;2Hzw@x,gavfB-!{CcF&T#Roe;RodwWbBg5urRgaKvHC*_6Vz+<4opieuew&Rmq@d]&Y)X,T#X0Rh}<BqP=4qS9:ReMg/ujReNJw0!/<Jui%!bd{kawwnemRelAxUa?a3#*.&UX(Ya+a/RhvRnQ<o}9Wmtd-#Y&RgSRmw9;Rmxay=Rmyg-vaRmuxEhSrNu,v-voC!%(aR.a(a7+1Ro1>Ro5CE{A9b]{@;5x#eO{:g;urRi+KrNA!%(Ro3>Ro79;Ri_Ku@>{;&!x%gX|{KunA_+g5QRj/g3u5Rj#g>uERj%wio/xRhS&!,!#^1U}wba{8>>@=be}qC@:D5ba{7Ku+A&!}x?ba}t>>@=be}se(aA^^^Uat!b0#{pa+awUazbGa#aLb9bgaWac'a5TbS=Br!d1#`%scp_Jvl!#rT>Re0JvX&!VyN=H{Fcm#U&:pY=ReaJv2&!]h0=]nUJvG'!6Vy|=<r%JrM_=]h2@Wlud'#)U'Wf'b]{i=]h/Jvh!&~BpWg=v]RnMx+ny#'Nu;pVwjnu=]nwxJnx,T#`&Reqwjnt=]nvieu9vrRjLLuYwP(#+!th@wih5pX~Gr'g5v/Rh4KunA'!-CARnP@wwiN:Rm_9x'cvw>!|l=<saKvAA!0&3@q}>w^e1bp#&Re2Re3BDx7gH#T|f5H|eKuZ>!%(:qNAH{]Jv6!+3B2B9=b^{X<5<B92:E{ZLvhwA(a;a%!igQuyRmad+#Y}m@3Rh5d8#X'X*:AqUAHzmaxwbh<aXRnVcF}RT#Nw&cj#U(BWnug/vsRntdka)(a3+.Zb7aYYan1!bVa@Xa}[y^@b[{G=H{+hFu73Rj&Pv#5ReQcK%T#sig1v{Rj'Ku+D#'!t]~Grm~?rkKuMB!01d5#`'Vy.ta3Dtu~Hroc8#'{^45s85AwZbP&!#Rn!wghxWn#KvEA!)&2RlA2RlBx:h|#(T,=]j09Wobz>x]z/@awRoTd+#Y(az]hFhCrm4d,#Y+jTv|Q~EfMj]uNr|~FRfOdCa!Xa9_X#@<plJvf!%b`{(9;Rgwc;.!#2x7cw#T|UDb]|T5Ju={(!=@E{&Jv)&!Ab`{'awJvf!~*>>@=be{#KuY>!+&4Ezyi[ugv&RjIdea+T)#UXa&T-T&a!Rh9auRmW=]kLg5vuRn+g3u4Rn-Ow6ARn,hHus5xNk?#UX(U~)/g8v0RkD~AwkkF?Ri.OuNBwkkA?Ri/d|a2`a*^UYa.!aBTZaTa'Xa;!(!2!-a#b2[yC>6Vyq3[xr2Wi?g1rusVh%s?DtF~<5rbJs;%!DtBfswKtCj[uvuSsEu3RgVx3o:u+wN'*Zt;@3rd~Grh~?rfg8w)Lq)qE&-a%!>bI|`jWv0vV~EfCjTv|vV~Ef@j]uNpn~FRfBcK#T']gWNu7x,k7q4ai(0!hHv8<RhmkMu9vrsBuev/RhlCJvB!,g<v{wchh~@:Rhji[vrv{wchi~@:RhkdS&a5UY#Ta!RgPwwiI5BwciI~@:Rh`x'iJvj'!5]iJPu8Bwch]~@:Rhach)U#h3rp]gLh@t|Ax,hTq3ah!-(~@:Ro0Ou!5RhXj^v(pyw8unRhVd|)`,^UYas!a?/a2Z'a^Ta{Tb7Ta(a#!a,Wf&9sZ3DtAadamov=Bqt3[xig8vsRm~>waiL2b`{QJv*_Ouv2qgj<v]v2BqfdR'X*X#Y-@3qr~Gqv~?p6hHv-]glPup5Lq+q?_%*b_{qF{n9b^{rOu4ARhpKvCD!+&~Bqp:5Dbb}nwoiKl&unuTuBv]v+ueunaXRf0=Jvh!0nKufu8v1w&w7q%w&uHrz:Rgnj5w,uxDJq/(!hNw'5ReCk0s2u3w/w'5ReFd>Za&!*UaA=<wkgsRnSJv^!%Refifw3vyRgOKu_B'!,<]gkiiu:w&Rh<=C@a^<B57@2F{[<B5@aW:=3away9A5aW=<B=C@a^<B57@2F{Ie-#`(^^^bCara.b8aza6!/bZ,!adTbnTbOb+aFaS!aAT9@Wf~2Wli3Dtl2@d,#Y&RfnRfmJwJZtN~GqyJva&!VyMg<v~Rm%iXuJu3Rm9Jv[_=]ih9wlkDRkCd1#`(@Wg>2Wls3cH#T(@<Rj*=>Ri|b~'#23s9h<~El.d'#Y&Dtxi^rzvdRl#d*#U%(o|B2s`hJwSaxRmDKv4B&!1:Rmdd5#`'Vx}to~Hq{x'f1v3(!BA5ba|bJv_&!Wfug1v]ReIdO+U/Y#&G}-8wze=Rh{g1v]ReHg/uQRf/by#)ibQwERl/cH#T(@<Rj+=>Ri{cNu+vlax-!(#a0qa9<Rii2;;bU{H;x<i=&X#Rk`<4wwi=C9H~8xAI(Y#<azRi@45wXI<B9;5bb~7dL(X#Xa(+!aL6Vy{g5QqOau:5au2@ay547EzbxOcU(UX-T#Ta#:Cbb|A?wjh/b_|SOw6ARgtihr}u7Rhy<d1#T)X1@@=I|~=ay<2@@=aybb}Sj3vLv;<d,#Y(56H}A978H}@dGpvs@uAu`vcw9*!aFa+ai%(b!aXa8.a?a[ozWey=sU2@G}Nch&U#Rf_WexKu+D#'!t:~Gr`~?r^j]uNr|~FRg*j^psurwJt|RmcKv)@&!)7Rkv~Br[@wxfO:Rl3co#U'6Rezj_q#vIuavjRltwzeyh@vr5JqD0!>aY?C9:9au@9Cb]}9cl#U*5;5<H||jbuus1ucv&Rfvg1v~d/pppzqFr^a--a~!aMat1(hFv;Wiz@@=Izoj5uuv-7Rix~Cw`fk2WlVcZ#X,k)u3vWs@u2]ktg;wEx'fBq(_2Wg/jTv|vV~EfoJv]!15x'hzqG!(P~EfU~CRl_j6v(us5x4i-#T(2WmZ?C2F|d>Kq<aj1!*jTqIsBv=Wl`~Cw`fi2WlWj`v0u*~>RlR=c>Z,k#u3vWs@u2]kr<c1Z+jTqIsBv=Wla~Cw`fm2WlXdmb3!a{(arZa`bkTa%TbQTa-a9+c'!aM!/[yL=Bqug.w'RifhFvyDRj.g>vgwyk^9]k^Jv3_@WfbAARkhJw2_[x|JvB_wkoIRoKwkoJRoLd'(Y#<]gm=<9<H|yd'%_X#skDtb3awwqkgNulRkgdB#^',9:p'hJwSaxRmEBwVb8@4=H|qLu+w50&!)@3qs~?pU>Awwn;;Rn=c:Z'ARn<=<qwKvC@!/&~BqqJv6!&]eVb^z^xRge'/a%+^`#Sge}6<4Rn3=]n0Pw2>Rn8Jw0!&>Rn:>Rn6cY#a7+!a&=<wkaNw~h3z_c5Z{=wjh#=]nLKv^D!&)Vyz=bW|swYb<WetcG#T(2wxa@qVx@gD#Y&b^|V5JwG&!5bb|pg/w&RgD@x=kHs=uAvn!a%%/'+RmSRh694Ro`g-vaRmRhHv-]mlxCcS#`&ba~.5cD#Ta)P~=d,#Y(56H{>978H{Dd_#{2^Y%_+qbbb{6g3sERhsbU{?dfa.,`a(Xa<!aiX#(55RiG54RiHcI#T'WiU3RiVNvdwtfcRlKNvdd,#Y&RlHRlExQgf.1*^T'X#Sgf}6Wn4=]hfPrk>Rn7Jw0!&>Rn5>Rn9Lunw?&a2!,5<oq@@wqfdRlJj5Q~=d,#Y(~ARfcOuN]fdDKw;ay(}i!547E}j?cI#T(@5bV}iCbV}hdv(^^Tb?a40,b##Tbo!a*bR!a<b|a/!aKai!aU[yK=]o^g:v>ReGJwPZtK<7Rh+h<~El,Pv#5ReR@awwxjCg,ulRjDJv6&!]j!z?aQeeg>w=Sh<eeJw;!&axEzOg,Qosc!#*:wkeJ]eJ>x'h-u(!%Ro.w~h.zPdNZ(X,Ya![x{;9ReY;wkgxRiF:x?ap#Y&RmUg<s2Rkod]+UY0TZ'!a&A9sw<=bczLNvuw{gqzNhJwSaxRmCKuLay!#&s_Rf-55b^{uJvZa!!c%#(55Ri654wmiu5RiuawLu,vp!+}^%b_}Y9;wkgxba}o>A9:=b^}zKuh=a''!3awRk3c*'!#aHRk6c+Z&Rk5Rk4Jv)&!awRjSawd9*`#0?C2@EzMj8u<uJ5RmbjQrquJu3x,k>uq@_+=ayb^|W~ARkEOuN]k@7dhzV^X/X&a-#zRzSb`zXcJzTT#2WkVKvDBzW!%FzY9;5bbzWjQrquJu3Jw3%!b`zU=ayb^zQd:#X(T-a!6Vyywxh}=b]{Jg=u1RiAdGp~qHtzv!w(wA+a+a;<!aJaYai'anasb(=azRmV:Cbb{MLq2vb!%')RjuRjrRjtRjqx3jnqCw3!%')Rk(Rk+Rk&Rk)Lq2vb!%')Rj{RjxRjzRjwLq2vb!%')RjsRjpRjfRjex3jcqCw3!%')Rk'Rk*RjkRjl9<CbbzfOu4ARhxLq2vb!%')RjyRjvRjhRjgx=joq*uKvb!%')+-Rk.Rk%Rj~Rk-Rk#Rj}x=jdq*uKvb!%')+-Rk,Rk!Rj|RjmRjjRjidAq&qKs@uAv8Aa.'*-a@a&0!aM@a5[y73Dsy3Ds|3Dt):wxgI2sHJwJZt.~Gqxwsf0ikrzt}Rl0Jvy_[xj~HqzKv_A|D!&WfP8axRoVcf,U#k(v]v+ueunaXRf1Ju}'!g8u#Ri=jQw!sCunLprq>!,')~<5qeGzq9F{W=c##%s5au:5aU3CBE|;d4#X(D!a&6Vygx(b;#(=]ed?C2F{N<capoq2r[a&!aPa9,'Pw;5s:@@=I|,55w_h|@@=IzcP~=x'fCqB_2Wl2>aU@@=I|1OuNBc1Z+jTqIsBv=Wlc~Cw`fl2WlZ~AcTa%!Z+jTqIsBv=Wlb~Cw`fh2WlYk+uNqJsBv=WlSg,u3dca3#UXaMYa)TaB-=cM|7T#<bI}l5@B932:aV2G{BOuNBJq:|M!5Ezt=<B=C@a^<B57@2F{v>cB{/T#=ay<bI{3Jv6!a.6BKq0ah&+!5E}HP~Ef{978BaU@@=Iza<7d#.Y#978BaU@@=IzH~AJq0!(@@=IzG978BaU@@=IzFe,aU*Y&^^^bvJb,b:bFad!a,c2Ta>aL.bo6!a#CbTa'T#Re{2Wlh2@G{yg6t~Ro_NvdRfticuRQRllJv3&!x&c|zs@Jw3!%RflwpfkRlpKuL;%(!Re<@G|C2GzdhIvuBwgjAg-u0RjAKQB%!(GzZ@G|5NuuRl7d='T+Y#Vy[g<v~Rm!==G|>JvA!)@wma=]m1ifuaw&RmnLs@vT'!|/+[y,g:v>ReTJw1!#qX=x!eC{bLu+wT&)ZtZauq_~Graci&U#F|89:r_Lupvq!.)&2RlG8RfaC=x!eF{_h?rpWlmd&'!#X|&]k::xJey#`'T|+<E|&2@H|%dE#(^,g;u.RiEg6vjRiC9xCkA{O|zY#g=ucRmXKs0@!&*@G|m@awRknJuh!,3d(}gY}eJvj!%Rm):Jw3!%Rm+Rm-Ls0w(&!a(a#@b[|6cZ#X'7RkxWgAOu4ARn'dH'U#Y*Vz-Wm'CARm}d]*#a%^a*T'aK!a<9bV{PC=p*Jw4!&SgxcbB5r]idw(wBRmF7xFkt#&`(Rm/Rm8E|!JuY_9:Rl5=wrgr2:bbxd@xXfB(a*#T+!.X0X1Ta/a'T&RlDRfL>RlyARl9b[z[>RfZ:RlL:RfRwlg/ARl;9;RlxKv,A/!%7s69<74=BA5ba{-8Bde#`a<XaKYa1,a'P~=wxfB2bZ}}?C972@@=I}r8@55B9;5bb}G978B2@@=aybb}3j3vLv;<Jw3&!>Rfk=ayb^}4~Ad1#`*@@=aybb{w2@>==<bbz]dx+UY#^UaF!a9!bB'Ya1.!ajXa#%olRhD[y=3Dt#Ov5BrHKuMB%!(Rf^Wep~HrJwkiQjKr|~FRg)Ku+D#'!t5~GrF~?rDdV)UY,Z/_7RkuG{<~BrBg,rlsO:235B@bX}|d?a1!#`(6Vyn5@d##Y+jTv|vV~EfIj]uNpn~FRfH7Lq2vb1!a9-978BaU@@=Iz9978BbU}#~AJq0!(@@=Iz8978BaU@@=Iz7~AJQ|}!978BbU}!JvkaK!AdUa21-U#`a+(g/vsRn~Ou!5RPj:rmu9WhOjXuvvNr}:RhAj^v(pyw8unRn[kPr}p|u7vwv]RiSBd;pppzq@qHQa?(b.!a.a`@.|xa(hFv;Wiyj5uuv-7Riw~Cw`fg2WlU978BbU|wOuNBJqG!(P~EfD~CRlQcZ#X,k)u3vWs@u2]ksg;wEx'f@q1_2Wg.j]uNpn~FRfqJv]!15x'h{qG!(@@=IzK~CRl^j6v(us5x4i,#T(2WmY?C2F{1>Kq<aj1!*jTqIsBv=Wld~Cw`fj2Wl[j`v0u*~>RlT=c>Z,k#u3vWs@u2]kq<c1Z+jTqIsBv=Wle~Cw`fn2Wl]dn1#c(a(b^a2!b/bAT(bj!aDa7bu,a_a{c0!2T0g:v>ReD2@G{42@G{5~DpM~<5rc=Bx6i>{RT#RnI@zCx]y]z:2Jv[!zr5Awyk]9]k]dD(Y+X#6Vz.g=wKtgwhaCwgmTWj2Lu,w%_+/[y-B;b^xeg3u3Rj-2@bX{*KrJ<!+'@Wg(g?QRlC@Jv`!%b[zIwsfII}8JQ_@w|kW|=Jv(%!AqcOuNBJvEzh!bYzjLs@wP#(0!oy@>RkdJwMZtc3Dtd@BcG#T'9bWxg2@2Fznd*#Y+;2x'c}w<zizixNgwa#Z'U+!/!a'!a+w~g~z6wcn{Rn}wcnzRn|5Rh%=]nJg5vuRmvNvdRlvcprJu}w*az*a#!%.a.'Bot9qT]kj@Wg'ay2Gzv@Jv`!%b[zEwsfHI}1;ck#Ux`<Cbbx_Lu+w!a&0*!wko*wwo,So,}6Juqxf!E}PigQuyRm`d3(`#8>Rn%:A5B;bZ~%KvhCa!a2!x>k7#Uxb@b{#xaRk7Jw0!)>wwhlShl}6>wwhmShm}6CJvB!.x'hhvj{!!5Bwkhhbaz}x'hivjz~!5Bwkhibaz|xEhTrNu,v-vpD!a%&/)a3a.,%Ro2t[CE{)@3re9b]{%wjo09:rgc:Z&Ro6=<riifuaw&RmoKrNA!%(Ro4>Ro89;Ri`dSaL'UYzxZb)7Rka3xRhT&!,!#^1U}vbaz{>>@=be}yC@:D5bazzKu+A&!}{?ba}y>>@=be}wxBh[t`u~vJvr!%a!a()a,a0a4RoC=]o;Ju(!%RoGRhdwjh`=]oAg>w#Ro?g5vuRo=NvdRl|Ku]C.!&;RoEJvB!%RoORoMBx'h[v+_?w~h`}~5?w~hd~!xKh]oiptu-utv.vp!#%&a30a@a'a+(a/aOp(o~p!RoDJu(!%RoHRhewjha=]oBNvdRl}g>w#Ro@g5vuRo>c[#X']o<CauRoRAd-#Y':RkpauRoQKu]C.!&;RoFJvB!%RoNRoPBx'h]v+_?w~ha}t5?w~he}ue!/UbhYacXaW^Tc&a;b:a-c/#b&aja1(!cL+!bKbt!bmcRc9aIc?8[yW3Dtt94Rg`Jv}!&SiRMzBhEebShEMNuPRe>x7gL#TzuwjirRipc<Z&>on;>z=h-MSh.Mwqczx'a7vj&!>Re4@=ResJt__NuPRi*NuPRi)j]uNr|~FRfzKrJ>_+@Wfy@Wf]2WocKrJ<!+'@Wg%g/QRl@@Jv`!&awRl<wsfFIzgLu(w*!.*&ShBMwvhIRhI9;RhNx1hK'!#Sn]Mx1hK~0!#:2<H~7cNu+w7D*'1ZtW>Rn1~?rOc:Z&Rn2=<rQ<7wjh&=BSnLMc]#X(6Vz)w[b=a!U#9wzgMc3#&(RgMRitRis<x,gKt`ax!&+SioM=BSilMc3#&(RgKRinRimKurB,!&SiQMzBhDebShDM6BJQ!(P~Efx978B2@@=I}WLrJw!!,a*&@G}O@9wkibRid@@x'fKwC!&SlDMSfLMjUv~Q~EfKKv3@a+!(hFv-]mpx/hYZ(C5RiWz<o/MwkhY?So/M@x,gbvfB*&!SgEM:SoeeehFu3:Rgbda(,^TZa)X/7Sg[eb:2RgI~BrMC@wgkc:wwkcRerx3h(uUvK!&*,SnOM4Sh*MArRg;wHRh(x=h;rJvPwI!a4',a'0@Wg&=BSh/Mg>w=Rh=g3w*wwgGRgGcW(X#;Sg}M2Gzk@Jv`!&awRl=wsfGIz`dKZ*T'Y-:RhR7RhQg5u-p`j6v(us5d,#Y+~Awkia?RicOuNBwkibba}Ld6p~tyu_vbAa'a+!a/'a3aEa8a!>Sh,ebJv{!&Sh@ebSaReb9;SgwebNuPRi(NvdRl)NuPRi'hHu^<Rm^Jvv_@Wl(g;u1Si/ebKu'B&!*Sh?eb@Wl'z@aPeb95Si.ebcpputyvjB)!,&a+0a%ShAMWeK@G}C@WfJ9;RhMwvhH9w{ia}ix,hJvRA1(!zAn[MRhHx1hJ~*!#hFv(BSn[MBJQ!(@@=I~'978B2@@=I}2db.Ua<'X}+T#a0XaG2G}E;wkg|wuh!Rh!x,hZu,@)!&So0MVy)C5RiXACJvB!&5RiY5RiZg8w)cG}*T#2@bU}=KsA>(!a.3wkhZba~(x,h^u(A!&(SoCMRhb5Bz=h[eb?w~hb~6x,h_u(A!&(SoDMRhc5Bz=h]eb?w~hc~6e)aA1T#T,^^^c-bMb&blcPaP(a/!0!bA=b5c@a(!bfbrc#2afwmhARnjwchORnp2Wlf3DtsNvdRl-2@wpa<]m0bx(#:awRk2@Jw3!%RfhwpfgRlnKQB%!(G{V@G|'NuuRl6d='T+Y#VyUg<v~Rl~==G|<Jv+'!aYShC}6@B<5?ba~8@Jw3'!g2QRljhLrpWlOd+#Y'g.w'rIg>w*wgj@g-u0Rj@Lu+wT&)ZtUauq]~GrGci&U#F|39:rELrNvj!.%*RhCwunfw~nf~:9;Ri]>wtnhg;wHRnhx3hDs@v~!/+'@Wfr@9RkSNu&Rlo=@<5GzoKs0@_+@Wl+@awRkmJuh!-3d(}pY#qWJvj!%Rm(:Jw3!%Rm,Rm*de&!1U-U#`)Re;@G|.@9Ri82@wjfvRlq=@<5GzpLvOvr!).&2RlF8Rf`C=x!eE{.Jw3_g2QRlkhLrpWlPde(!#U{s,UXa*Ta'[y'g:v>ReS;x0PZ&RnlRnn~HrKJw1}f!=x!eB|2w]aP(#Xa&a*Ta.Ua2a7=]iOd'#Y&Ro&WnWg;u.RiDg6vjRiBNvdRlzhNvj]nYJuW_2Wm3x)kFze{9d])!a.!,Y01!#&aC!a3RndC=ox~BrC@2b^{pg,rlse7x'ksuq!%Rm.E{xidw(wBRmGx9o+)X#wwo-So-}69:Rl4@xSf@a#XZ'X)X,Ta(/ARl8b[xc>RfY:RlI:RfQwlg.ARl:9;Rlwdn'#^XafaQa1X1TaHTa)@b[{zcZ#X'7RkwWg@Ou4ARn&x)kG#{,g7u/RkGdH'U#Y*Vz'Wm&CARm|bx#(A]gUbUzJj9Q~=d,#Y(56H}l978H{U7d,0#U*2>ABb_xZ978BbU{e~AJQ{g!978BbU{hxMh?ad{oUYZ.x1h?{l!#:2<H{mx3n[t{vl!,&a%3Ro(z=iS}6ARnr=Bwsn^wvn`Rnbd`*T}B0!#^X'BG{c9b]{a>>@=be}F?JvS!&BG{d7BG}(Bde#`a1X,Ya@!a'P~=wxf@2bZ}I56B2@@=aybb}08@55B9;5bb}<j3vLv;<Jw3&!>Rfg=ayb^}&OuNBKuLA!)a!P~=x#fD{f2@>==<bbzl?C972@@=Ix^d6rSu,v7w*C(0a)a6#B+a%!sQ[y?3Dt%3[xn~<5rLOu!5p@Ku+D#'!t7~GrP~?rNKvlaya7'!h+v-5qMg=t|cd,U#5AAaa5Abb{S@52B5@a[@52B5Gx[iXueu;d<#`a(!/549C;ag>23ExY5@Dah89b^~689Jv)!~2b[~1Lv'w(%*!a#bX|aPrmawRe]keu7uhv-q6rxu,q`xTo]/a5aU!bNaDXbi!b-!ao!b<bwA!#5@B932:aV2G|:d-)Y#hJrL>RhG<7@C5<H|_=Cau:5aj5@B932:bJ|ng>vIbs)#?C2F|9jPv0w.vISh-MKvUaz(.!9ABbb|[5;5<H|Eg>unwfh;9:4E|YjQsBt|vjx'hYq3!(?C2F|J:2<BaY?C2F|GOu!5x,g|p{ah!-(?C2F|c9:4E|OjXuvvNr}:Rh&i[w*t|cd+U#jJvsu)vsSn~Mkfrmu9p}u7vwv]So!McW#Xa!ax5@A5aY:5;5<H|>kJv~vYrquJu3x4ib#T)2@SmZM?C2F|Bj:rmu9@xPhI(a*a#U#`a3-5Abb|L~@:RhK9:4E|0@52B5G|#C::aY?C2F|-:2<BaY?C2F|.5Jvk!a)javYrquJu3x4ia#T)2@SmYM?C2F|HAxPhH(!a#U#`a*-5Abb|4~@:RhJ9:4E|R@52B5G|F:2<BaY?C2F|Sc^#Xa2j=Qq5CJvB!-g<v{z;hhM?C2F|Zi[vrv{z;hiM?C2F|XKsA>!a)-g<v{z;h[eb?C2F|]i[vrv{z;h]eb?C2F|^iZu.vix,hZq3ah!.(?C2F|QOu!5ShXM:2<BaY?C2F|P", 13_494, 2713, 49, 25, 61);
//# sourceMappingURL=decode-data-html.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/entities/dist/generated/decode-data-xml.js"
/*!********************************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/entities/dist/generated/decode-data-xml.js ***!
  \********************************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   xmlDecodeTree: () => (/* binding */ xmlDecodeTree)
/* harmony export */ });
// Generated using scripts/write-decode-map.ts
/** Packed XML decode trie data. */
const xmlDecodeTree = /* #__PURE__ */ new Uint16Array([
    512, 26_465, 29_036, 7, 0, 2, 4, 116, 24_638, 116, 24_636, 8693, 29_807,
    24_610, 621, 1, 0, 0, 3, 112, 24_614, 111, 115, 24_615,
]);
//# sourceMappingURL=decode-data-xml.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/entities/dist/internal/bin-trie-flags.js"
/*!******************************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/entities/dist/internal/bin-trie-flags.js ***!
  \******************************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BinTrieFlags: () => (/* binding */ BinTrieFlags)
/* harmony export */ });
/**
 * Bit flags & masks for the binary trie encoding used for entity decoding.
 *
 * The trie is a flat `Uint16Array`. Every node starts with one header word:
 *
 *   15..14 VALUE_LENGTH   Number of words the value occupies, +1.
 *                         0 = no value; 1 = value inline in bits 12..0;
 *                         2/3 = value in the 1/2 words after the header.
 *   13     FLAG13         If VALUE_LENGTH > 0: semicolon required ("strict"
 *                         entity; `;` is never stored as a branch).
 *                         If VALUE_LENGTH == 0: this node is a compact run.
 *   12..7  BRANCH_LENGTH  Number of branches (or run length for runs).
 *   6..0   JUMP_TABLE     Jump-table offset / single-branch char / first
 *                         run char (see below).
 *
 * Branch data follows the header and any value words. Its shape is selected
 * by (JUMP_TABLE, BRANCH_LENGTH) in the header:
 *
 *   Single branch  JUMP_TABLE = the only child's char, BRANCH_LENGTH = 0.
 *                  No branch words; the child node follows immediately.
 *   Jump table     JUMP_TABLE = first covered char (> 0), BRANCH_LENGTH =
 *                  table length. One word per covered char: 0 = no branch,
 *                  otherwise the child's offset from the END of the table,
 *                  +1 (so 0 stays the no-branch sentinel).
 *   Dictionary     JUMP_TABLE = 0, BRANCH_LENGTH = number of branches.
 *                  ceil(n/2) words of sorted keys packed two per word
 *                  (low byte first), then n pointer words storing the
 *                  child's offset from the END of the branch data.
 *   Compact run    VALUE_LENGTH = 0, FLAG13 set. BRANCH_LENGTH = run
 *                  length (3..63), JUMP_TABLE = first char; remaining run
 *                  chars packed two per word after the header. The target
 *                  node follows the packed words immediately.
 *
 * Pointers are end-relative (rather than relative to the pointer's own
 * position) because that makes the common "child encoded right after the
 * branch data" case a small constant, which compresses far better. Offsets
 * to already-encoded (shared) nodes wrap via uint16 modulo arithmetic; the
 * decoder masks navigation results with `& 0xff_ff` to match.
 */
var BinTrieFlags;
(function (BinTrieFlags) {
    BinTrieFlags[BinTrieFlags["VALUE_LENGTH"] = 49152] = "VALUE_LENGTH";
    BinTrieFlags[BinTrieFlags["FLAG13"] = 8192] = "FLAG13";
    BinTrieFlags[BinTrieFlags["BRANCH_LENGTH"] = 8064] = "BRANCH_LENGTH";
    BinTrieFlags[BinTrieFlags["JUMP_TABLE"] = 127] = "JUMP_TABLE";
    /** Bits 12..0: the inline value of a VALUE_LENGTH = 1 header word. */
    BinTrieFlags[BinTrieFlags["VALUE_MASK"] = 8191] = "VALUE_MASK";
})(BinTrieFlags || (BinTrieFlags = {}));
//# sourceMappingURL=bin-trie-flags.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/entities/dist/internal/decode-shared.js"
/*!*****************************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/entities/dist/internal/decode-shared.js ***!
  \*****************************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   decodeTrieDict: () => (/* binding */ decodeTrieDict)
/* harmony export */ });
/*
 * Inverse of the encoder's SAFE alphabet (0x21..0x7E minus 0x22, 0x24, 0x5C),
 * precomputed once at module load. Entries for excluded chars stay 0 but
 * are never read.
 */
const BASE91_INVERSE = /* #__PURE__ */ (() => {
    const table = new Uint8Array(127);
    let code = 0;
    for (let char = 0x21; char <= 0x7e; char++) {
        if (char !== 0x22 && char !== 0x24 && char !== 0x5c) {
            table[char] = code++;
        }
    }
    return table;
})();
/**
 * Decode a dictionary-encoded trie string back into its Uint16Array.
 *
 * Stream layout (consumed in this order):
 *   1. dict1 atoms — `dict1AtomCount` uint16 values, delta+RLE encoded.
 *   2. dict2 atoms — `atomCount - dict1AtomCount` values, delta+RLE.
 *   3. dict2 ngrams — `ngramCount - (dictSize - dict1AtomCount)` entries,
 *      each a pair of slot codes that resolve to earlier slots.
 *   4. dict1 ngrams — `dictSize - dict1AtomCount` entries, same shape.
 *   5. data — slot codes, each expanding to one or more uint16 values.
 *
 * Codes use a 91-char base (printable ASCII minus `"`, `$`, `\`):
 *   - char1 < dictSize  → 1-char code, slot = char1
 *   - char1 ≥ dictSize  → 2-char code, slot = dictSize + (char1 - dictSize)*91 + char2
 *
 * Slot index → token kind:
 *   [0, A)                  dict1 atoms     (1-char codes)
 *   [A, dictSize)           dict1 ngrams    (1-char codes)
 *   [dictSize, dictSize+D)  dict2 atoms     (2-char codes)
 *   [dictSize+D, end)       dict2 ngrams    (2-char codes)
 *
 * Both atom dicts decode before any ngram, and dict2 ngrams decode before
 * dict1 ngrams. So every ngram entry references slots whose contents are
 * already filled — no forward references to handle.
 *
 * This runs on library import. Flat typed arrays store each slot as either
 * a plain value (`single`, covering every atom) or a range in a shared
 * `pool` (ngrams).
 * @param input Packed trie string.
 * @param resultLength Expected number of uint16 values in the output.
 * @param atomCount Total number of distinct uint16 values in the trie.
 * @param dict1AtomCount Atoms in the 1-char range (`A` above).
 * @param ngramCount Total number of ngram entries (dict1 + dict2).
 * @param dictSize Number of 1-char code slots; the rest of `BASE - dictSize`
 *   first-byte values are 2-char codes.
 */
function decodeTrieDict(input, resultLength, atomCount, dict1AtomCount, ngramCount, dictSize) {
    const base = 91;
    const inputLength = input.length;
    // For 2-char codes, slot = char1 * base - twoCharBias + char2.
    const twoCharBias = dictSize * (base - 1);
    let pos = 0;
    /** Read one slot code at `pos` and return its slot index, advancing pos. */
    const readSlotCode = () => {
        const c1 = BASE91_INVERSE[input.charCodeAt(pos++)];
        return c1 < dictSize
            ? c1
            : c1 * base - twoCharBias + BASE91_INVERSE[input.charCodeAt(pos++)];
    };
    const dict2AtomCount = atomCount - dict1AtomCount;
    const slotCount = atomCount + ngramCount;
    /*
     * Per-slot contents: atoms (always a single value) live directly in
     * `single`; ngram slots hold -1 there and expand to
     * `pool[start[slot] .. start[slot] + length[slot])`.
     */
    const single = new Int32Array(slotCount);
    single.fill(-1, dict1AtomCount, dictSize);
    single.fill(-1, dictSize + dict2AtomCount, slotCount);
    const start = new Int32Array(slotCount);
    const length = new Int32Array(slotCount);
    /**
     * Decode `count` ascending uint16 values from a delta+RLE stream into
     * `single[off..off+count)`.
     *
     *   code < 89   → delta = code
     *   code == 89  → run-length: next char encodes runLength-2; emit `runLength` consecutive +1 values
     *   code == 90, next < 90  → escape: delta = 89 + next * BASE + after-next
     *   code == 90, next == 90 → double-escape: extra char for very large deltas
     * @param count
     * @param off
     */
    function decodeDelta(count, off) {
        let previous = 0;
        let slot = off;
        const end = off + count;
        while (slot < end) {
            const code = BASE91_INVERSE[input.charCodeAt(pos++)];
            if (code < 89) {
                previous += code;
                single[slot++] = previous;
            }
            else if (code === 89) {
                let runLength = BASE91_INVERSE[input.charCodeAt(pos++)] + 2;
                while (runLength--)
                    single[slot++] = ++previous;
            }
            else {
                const next = BASE91_INVERSE[input.charCodeAt(pos++)];
                previous +=
                    89 +
                        // eslint-disable-next-line unicorn/prefer-minimal-ternary -- branches read a different number of side-effecting input bytes
                        (next < 90
                            ? next * base + BASE91_INVERSE[input.charCodeAt(pos++)]
                            : BASE91_INVERSE[input.charCodeAt(pos++)] * 8281 +
                                BASE91_INVERSE[input.charCodeAt(pos++)] * base +
                                BASE91_INVERSE[input.charCodeAt(pos++)]);
                single[slot++] = previous;
            }
        }
    }
    // Streams 1 & 2: atoms decoded into their slot ranges.
    decodeDelta(dict1AtomCount, 0);
    decodeDelta(dict2AtomCount, dictSize);
    /*
     * Streams 3 & 4 are read in two passes: first collect every ngram's two
     * references and derive its expanded length (each ref resolves to an earlier
     * slot, so lengths are already known), which sizes the shared pool.
     * Pool ranges are handed out in decode order, so the second pass fills
     * the pool contiguously with a single write cursor.
     */
    const references = new Int32Array(ngramCount * 2);
    let poolSize = 0;
    let ngramIndex = 0;
    /**
     * Read `count` ngram entries (each = 2 slot-code references) for the slots
     * starting at `startSlot`, recording references and assigning pool ranges.
     * @param count
     * @param startSlot
     */
    function readNgramReferences(count, startSlot) {
        for (let index = 0; index < count; index++) {
            const slot = startSlot + index;
            const a = readSlotCode();
            const b = readSlotCode();
            references[ngramIndex * 2] = a;
            references[ngramIndex * 2 + 1] = b;
            ngramIndex += 1;
            start[slot] = poolSize;
            const entryLength = (single[a] < 0 ? length[a] : 1) +
                (single[b] < 0 ? length[b] : 1);
            length[slot] = entryLength;
            poolSize += entryLength;
        }
    }
    readNgramReferences(ngramCount - dictSize + dict1AtomCount, dictSize + dict2AtomCount);
    readNgramReferences(dictSize - dict1AtomCount, dict1AtomCount);
    // Second pass: concatenate each ngram's two halves into the pool.
    const pool = new Uint16Array(poolSize);
    let write = 0;
    for (let index = 0; index < ngramIndex; index++) {
        for (let half = 0; half < 2; half++) {
            const source = references[index * 2 + half];
            const value = single[source];
            if (value < 0) {
                let read = start[source];
                const readEnd = read + length[source];
                while (read < readEnd)
                    pool[write++] = pool[read++];
            }
            else {
                pool[write++] = value;
            }
        }
    }
    // Stream 5: data. Each code expands to its slot's stored values.
    const out = new Uint16Array(resultLength);
    let outIndex = 0;
    while (pos < inputLength) {
        let slot = BASE91_INVERSE[input.charCodeAt(pos++)];
        if (slot >= dictSize) {
            slot =
                slot * base -
                    twoCharBias +
                    BASE91_INVERSE[input.charCodeAt(pos++)];
        }
        const value = single[slot];
        if (value < 0) {
            let read = start[slot];
            const readEnd = read + length[slot];
            while (read < readEnd)
                out[outIndex++] = pool[read++];
        }
        else {
            out[outIndex++] = value;
        }
    }
    return out;
}
//# sourceMappingURL=decode-shared.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/htmlparser2/dist/Parser.js"
/*!****************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/htmlparser2/dist/Parser.js ***!
  \****************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Parser: () => (/* binding */ Parser)
/* harmony export */ });
/* harmony import */ var _Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Tokenizer.js */ "./node_modules/sanitize-html/node_modules/htmlparser2/dist/Tokenizer.js");
const { fromCodePoint } = String;

const formTags = new Set([
    "input",
    "option",
    "optgroup",
    "select",
    "button",
    "datalist",
    "textarea",
]);
const pTag = new Set(["p"]);
const headingTags = new Set(["h1", "h2", "h3", "h4", "h5", "h6", "p"]);
const tableSectionTags = new Set(["thead", "tbody"]);
const ddtTags = new Set(["dd", "dt"]);
const rtpTags = new Set(["rt", "rp"]);
const openImpliesClose = new Map([
    ["tr", new Set(["tr", "th", "td"])],
    ["th", new Set(["th"])],
    ["td", new Set(["thead", "th", "td"])],
    ["body", new Set(["head", "link", "script"])],
    ["a", new Set(["a"])],
    ["li", new Set(["li"])],
    ["p", pTag],
    ["h1", headingTags],
    ["h2", headingTags],
    ["h3", headingTags],
    ["h4", headingTags],
    ["h5", headingTags],
    ["h6", headingTags],
    ["select", formTags],
    ["input", formTags],
    ["output", formTags],
    ["button", formTags],
    ["datalist", formTags],
    ["textarea", formTags],
    ["option", new Set(["option"])],
    ["optgroup", new Set(["optgroup", "option"])],
    ["dd", ddtTags],
    ["dt", ddtTags],
    ["address", pTag],
    ["article", pTag],
    ["aside", pTag],
    ["blockquote", pTag],
    ["details", pTag],
    ["div", pTag],
    ["dl", pTag],
    ["fieldset", pTag],
    ["figcaption", pTag],
    ["figure", pTag],
    ["footer", pTag],
    ["form", pTag],
    ["header", pTag],
    ["hr", pTag],
    ["main", pTag],
    ["nav", pTag],
    ["ol", pTag],
    ["pre", pTag],
    ["section", pTag],
    ["table", pTag],
    ["ul", pTag],
    ["rt", rtpTags],
    ["rp", rtpTags],
    ["tbody", tableSectionTags],
    ["tfoot", tableSectionTags],
]);
const DOCUMENT_TYPE = "doctype";
const voidElements = new Set([
    "area",
    "base",
    "basefont",
    "br",
    "col",
    "command",
    "embed",
    "frame",
    "hr",
    "img",
    "input",
    "isindex",
    "keygen",
    "link",
    "meta",
    "param",
    "source",
    "track",
    "wbr",
]);
const foreignContextElements = new Set(["math", "svg"]);
/**
 * Elements that can be used to integrate HTML content within foreign namespaces (e.g., SVG or MathML).
 *
 * Entries must use the SVG-adjusted casing (e.g. "foreignObject" not
 * "foreignobject") since they are compared against adjusted tag names.
 */
const htmlIntegrationElements = new Set([
    "mi",
    "mo",
    "mn",
    "ms",
    "mtext",
    "annotation-xml",
    "foreignObject",
    "desc",
    "title",
]);
const svgTagNameAdjustments = new Map([
    ["altglyph", "altGlyph"],
    ["altglyphdef", "altGlyphDef"],
    ["altglyphitem", "altGlyphItem"],
    ["animatecolor", "animateColor"],
    ["animatemotion", "animateMotion"],
    ["animatetransform", "animateTransform"],
    ["clippath", "clipPath"],
    ["feblend", "feBlend"],
    ["fecolormatrix", "feColorMatrix"],
    ["fecomponenttransfer", "feComponentTransfer"],
    ["fecomposite", "feComposite"],
    ["feconvolvematrix", "feConvolveMatrix"],
    ["fediffuselighting", "feDiffuseLighting"],
    ["fedisplacementmap", "feDisplacementMap"],
    ["fedistantlight", "feDistantLight"],
    ["fedropshadow", "feDropShadow"],
    ["feflood", "feFlood"],
    ["fefunca", "feFuncA"],
    ["fefuncb", "feFuncB"],
    ["fefuncg", "feFuncG"],
    ["fefuncr", "feFuncR"],
    ["fegaussianblur", "feGaussianBlur"],
    ["feimage", "feImage"],
    ["femerge", "feMerge"],
    ["femergenode", "feMergeNode"],
    ["femorphology", "feMorphology"],
    ["feoffset", "feOffset"],
    ["fepointlight", "fePointLight"],
    ["fespecularlighting", "feSpecularLighting"],
    ["fespotlight", "feSpotLight"],
    ["fetile", "feTile"],
    ["feturbulence", "feTurbulence"],
    ["foreignobject", "foreignObject"],
    ["glyphref", "glyphRef"],
    ["lineargradient", "linearGradient"],
    ["radialgradient", "radialGradient"],
    ["textpath", "textPath"],
]);
var ForeignContext;
(function (ForeignContext) {
    ForeignContext[ForeignContext["None"] = 0] = "None";
    ForeignContext[ForeignContext["Svg"] = 1] = "Svg";
    ForeignContext[ForeignContext["MathML"] = 2] = "MathML";
})(ForeignContext || (ForeignContext = {}));
const reNameEnd = /\s|\//;
/**
 * Incremental parser implementation.
 */
class Parser {
    options;
    /** The start index of the last event. */
    startIndex = 0;
    /** The end index of the last event. */
    endIndex = 0;
    /**
     * Store the start index of the current open tag,
     * so we can update the start index for attributes.
     */
    openTagStart = 0;
    tagname = "";
    attribname = "";
    attribvalue = "";
    attribs = null;
    stack = [];
    foreignContext;
    cbs;
    lowerCaseTagNames;
    lowerCaseAttributeNames;
    recognizeSelfClosing;
    /** We are parsing HTML. Inverse of the `xmlMode` option. */
    htmlMode;
    tokenizer;
    buffers = [];
    bufferOffset = 0;
    /** The index of the last written buffer. Used when resuming after a `pause()`. */
    writeIndex = 0;
    /** Indicates whether the parser has finished running / `.end` has been called. */
    ended = false;
    constructor(cbs, options = {}) {
        this.options = options;
        this.cbs = cbs ?? {};
        this.htmlMode = !this.options.xmlMode;
        this.lowerCaseTagNames = options.lowerCaseTags ?? this.htmlMode;
        this.lowerCaseAttributeNames =
            options.lowerCaseAttributeNames ?? this.htmlMode;
        this.recognizeSelfClosing =
            options.recognizeSelfClosing ?? !this.htmlMode;
        this.tokenizer = new (options.Tokenizer ?? _Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__["default"])(this.options, this);
        this.foreignContext = [ForeignContext.None];
        this.cbs.onparserinit?.(this);
    }
    // Tokenizer event handlers
    /**
     * @param start Start index for the current parser event.
     * @param endIndex End index for the current parser event.
     * @internal
     */
    ontext(start, endIndex) {
        const data = this.getSlice(start, endIndex);
        this.endIndex = endIndex - 1;
        this.cbs.ontext?.(data);
        this.startIndex = endIndex;
    }
    /**
     * @param cp Current Unicode code point.
     * @param endIndex End index for the current parser event.
     * @internal
     */
    ontextentity(cp, endIndex) {
        this.endIndex = endIndex - 1;
        this.cbs.ontext?.(fromCodePoint(cp));
        this.startIndex = endIndex;
    }
    /** @internal */
    isInForeignContext() {
        return this.foreignContext[0] !== ForeignContext.None;
    }
    /**
     * Checks if the current tag is a void element. Override this if you want
     * to specify your own additional void elements.
     * @param name Name of the pseudo selector.
     */
    isVoidElement(name) {
        return this.htmlMode && voidElements.has(name);
    }
    /**
     * Read a tag name from the buffer.
     *
     * When `lowerCaseTagNames` is enabled (the default in HTML mode), the name
     * is lowercased and may be adjusted for SVG casing or the `image` → `img`
     * alias.
     * @param start Start index of the tag name in the buffer.
     * @param endIndex End index of the tag name in the buffer.
     */
    readTagName(start, endIndex) {
        const name = this.lowerCaseTagNames
            ? this.getSlice(start, endIndex).toLowerCase()
            : this.getSlice(start, endIndex);
        if (!(this.lowerCaseTagNames && this.htmlMode)) {
            return name;
        }
        if (this.foreignContext[0] === ForeignContext.Svg) {
            return svgTagNameAdjustments.get(name) ?? name;
        }
        /*
         * Closing tags for SVG elements inside HTML integration points
         * (e.g. </foreignObject> while inside its own content) need case
         * adjustment so the name matches what was pushed to the stack.
         * `foreignContext.length > 1` means a foreign ancestor exists —
         * the base [None] entry plus at least one pushed context.
         */
        if (this.foreignContext.length > 1) {
            const adjusted = svgTagNameAdjustments.get(name);
            if (adjusted !== undefined && this.stack.includes(adjusted)) {
                return adjusted;
            }
        }
        if (!this.isInForeignContext()) {
            return name === "image" ? "img" : name;
        }
        return name;
    }
    /**
     * @param start Start index for the current parser event.
     * @param endIndex End index for the current parser event.
     * @internal
     */
    onopentagname(start, endIndex) {
        this.endIndex = endIndex;
        this.emitOpenTag(this.readTagName(start, endIndex));
    }
    emitOpenTag(name) {
        this.openTagStart = this.startIndex;
        this.tagname = name;
        /*
         * The spec ignores a second <form> when one is already open.
         * Setting tagname to "" suppresses all downstream effects: attribs
         * stays null so endOpenTag is a no-op, and closeCurrentTag can't
         * match "" on the stack.
         */
        if (this.htmlMode && name === "form" && this.stack.includes("form")) {
            this.tagname = "";
            return;
        }
        const impliesClose = this.htmlMode && openImpliesClose.get(name);
        if (impliesClose) {
            while (this.stack.length > 0 && impliesClose.has(this.stack[0])) {
                this.popElement(true);
            }
        }
        if (!this.isVoidElement(name)) {
            this.stack.unshift(name);
            if (this.htmlMode) {
                if (name === "svg") {
                    this.foreignContext.unshift(ForeignContext.Svg);
                }
                else if (name === "math") {
                    this.foreignContext.unshift(ForeignContext.MathML);
                }
                else if (htmlIntegrationElements.has(name)) {
                    this.foreignContext.unshift(ForeignContext.None);
                }
            }
        }
        this.cbs.onopentagname?.(name);
        if (this.cbs.onopentag)
            this.attribs = {};
    }
    endOpenTag(isImplied) {
        this.startIndex = this.openTagStart;
        if (this.attribs) {
            this.cbs.onopentag?.(this.tagname, this.attribs, isImplied);
            this.attribs = null;
        }
        if (this.cbs.onclosetag && this.isVoidElement(this.tagname)) {
            this.cbs.onclosetag(this.tagname, true);
        }
        this.tagname = "";
    }
    /**
     * @param endIndex End index for the current parser event.
     * @internal
     */
    onopentagend(endIndex) {
        this.endIndex = endIndex;
        this.endOpenTag(false);
        // Set `startIndex` for next node
        this.startIndex = endIndex + 1;
    }
    /**
     * @param start Start index for the current parser event.
     * @param endIndex End index for the current parser event.
     * @internal
     */
    onclosetag(start, endIndex) {
        this.endIndex = endIndex;
        const name = this.readTagName(start, endIndex);
        if (!this.isVoidElement(name)) {
            const pos = this.stack.indexOf(name);
            if (pos !== -1) {
                for (let index = 0; index < pos; index++) {
                    this.popElement(true);
                }
                this.popElement(false);
            }
            else if (this.htmlMode && name === "p") {
                // Implicit open before close
                this.emitOpenTag("p");
                this.closeCurrentTag(true);
            }
        }
        else if (this.htmlMode && name === "br") {
            // We can't use `emitOpenTag` for implicit open, as `br` would be implicitly closed.
            this.cbs.onopentagname?.("br");
            this.cbs.onopentag?.("br", {}, true);
            this.cbs.onclosetag?.("br", false);
        }
        // Set `startIndex` for next node
        this.startIndex = endIndex + 1;
    }
    /**
     * @param endIndex End index for the current parser event.
     * @internal
     */
    onselfclosingtag(endIndex) {
        this.endIndex = endIndex;
        if (this.recognizeSelfClosing || this.isInForeignContext()) {
            this.closeCurrentTag(false);
            // Set `startIndex` for next node
            this.startIndex = endIndex + 1;
        }
        else {
            // Ignore the fact that the tag is self-closing.
            this.onopentagend(endIndex);
        }
    }
    /**
     * Pop the top element off the stack, emit a close event, and maintain
     * the foreign context stack.
     * @param implied Whether this close is implied (not from an explicit end tag).
     */
    popElement(implied) {
        // biome-ignore lint/style/noNonNullAssertion: The element is guaranteed to exist.
        const element = this.stack.shift();
        if (this.htmlMode &&
            (foreignContextElements.has(element) ||
                htmlIntegrationElements.has(element))) {
            this.foreignContext.shift();
        }
        this.cbs.onclosetag?.(element, implied);
    }
    closeCurrentTag(isOpenImplied) {
        const name = this.tagname;
        this.endOpenTag(isOpenImplied);
        // Self-closing tags will be on the top of the stack
        if (this.stack[0] === name) {
            this.popElement(!isOpenImplied);
        }
    }
    /**
     * @param start Start index for the current parser event.
     * @param endIndex End index for the current parser event.
     * @internal
     */
    onattribname(start, endIndex) {
        this.startIndex = start;
        const name = this.getSlice(start, endIndex);
        this.attribname = this.lowerCaseAttributeNames
            ? name.toLowerCase()
            : name;
    }
    /**
     * @param start Start index for the current parser event.
     * @param endIndex End index for the current parser event.
     * @internal
     */
    onattribdata(start, endIndex) {
        this.attribvalue += this.getSlice(start, endIndex);
    }
    /**
     * @param cp Current Unicode code point.
     * @internal
     */
    onattribentity(cp) {
        this.attribvalue += fromCodePoint(cp);
    }
    /**
     * @param quote Quote type used for the current attribute.
     * @param endIndex End index for the current parser event.
     * @internal
     */
    onattribend(quote, endIndex) {
        this.endIndex = endIndex;
        this.cbs.onattribute?.(this.attribname, this.attribvalue, quote === _Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.QuoteType.Double
            ? '"'
            : quote === _Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.QuoteType.Single
                ? "'"
                : quote === _Tokenizer_js__WEBPACK_IMPORTED_MODULE_0__.QuoteType.NoValue
                    ? undefined
                    : null);
        if (this.attribs && !Object.hasOwn(this.attribs, this.attribname)) {
            this.attribs[this.attribname] = this.attribvalue;
        }
        this.attribvalue = "";
    }
    getInstructionName(value) {
        const index = value.search(reNameEnd);
        let name = index < 0 ? value : value.substr(0, index);
        if (this.lowerCaseTagNames) {
            name = name.toLowerCase();
        }
        return name;
    }
    /**
     * @param start Start index for the current parser event.
     * @param endIndex End index for the current parser event.
     * @internal
     */
    ondeclaration(start, endIndex) {
        this.endIndex = endIndex;
        const value = this.getSlice(start, endIndex);
        if (this.cbs.onprocessinginstruction) {
            /*
             * In HTML mode, ondeclaration is only reached for DOCTYPE
             * (the tokenizer routes everything else to bogus comments).
             */
            const name = this.htmlMode
                ? this.lowerCaseTagNames
                    ? DOCUMENT_TYPE
                    : value.slice(0, DOCUMENT_TYPE.length)
                : this.getInstructionName(value);
            this.cbs.onprocessinginstruction(`!${name}`, `!${value}`);
        }
        // Set `startIndex` for next node
        this.startIndex = endIndex + 1;
    }
    /**
     * @param start Start index for the current parser event.
     * @param endIndex End index for the current parser event.
     * @internal
     */
    onprocessinginstruction(start, endIndex) {
        this.endIndex = endIndex;
        const value = this.getSlice(start, endIndex);
        if (this.cbs.onprocessinginstruction) {
            const name = this.getInstructionName(value);
            this.cbs.onprocessinginstruction(`?${name}`, `?${value}`);
        }
        // Set `startIndex` for next node
        this.startIndex = endIndex + 1;
    }
    /**
     * @param start Start index for the current parser event.
     * @param endIndex End index for the current parser event.
     * @param offset Offset applied when computing parser indices.
     * @internal
     */
    oncomment(start, endIndex, offset) {
        this.endIndex = endIndex;
        this.cbs.oncomment?.(this.getSlice(start, endIndex - offset));
        this.cbs.oncommentend?.();
        // Set `startIndex` for next node
        this.startIndex = endIndex + 1;
    }
    /**
     * @param start Start index for the current parser event.
     * @param endIndex End index for the current parser event.
     * @param offset Offset applied when computing parser indices.
     * @internal
     */
    oncdata(start, endIndex, offset) {
        this.endIndex = endIndex;
        const value = this.getSlice(start, endIndex - offset);
        if (!this.htmlMode || this.options.recognizeCDATA) {
            this.cbs.oncdatastart?.();
            this.cbs.ontext?.(value);
            this.cbs.oncdataend?.();
        }
        else if (this.isInForeignContext()) {
            this.cbs.ontext?.(value);
        }
        else {
            this.cbs.oncomment?.(`[CDATA[${value}]]`);
            this.cbs.oncommentend?.();
        }
        // Set `startIndex` for next node
        this.startIndex = endIndex + 1;
    }
    /** @internal */
    onend() {
        if (this.cbs.onclosetag) {
            // Set the end index for all remaining tags
            this.endIndex = this.startIndex;
            for (let index = 0; index < this.stack.length; index++) {
                this.cbs.onclosetag(this.stack[index], true);
            }
        }
        this.cbs.onend?.();
    }
    /**
     * Resets the parser to a blank state, ready to parse a new HTML document
     */
    reset() {
        this.cbs.onreset?.();
        this.tokenizer.reset();
        this.tagname = "";
        this.attribname = "";
        this.attribvalue = "";
        this.attribs = null;
        this.stack.length = 0;
        this.startIndex = 0;
        this.endIndex = 0;
        this.cbs.onparserinit?.(this);
        this.buffers.length = 0;
        this.foreignContext.length = 0;
        this.foreignContext.unshift(ForeignContext.None);
        this.bufferOffset = 0;
        this.writeIndex = 0;
        this.ended = false;
    }
    /**
     * Resets the parser, then parses a complete document and
     * pushes it to the handler.
     * @param data Document to parse.
     */
    parseComplete(data) {
        this.reset();
        this.end(data);
    }
    getSlice(start, end) {
        if (start === end) {
            return "";
        }
        while (start - this.bufferOffset >= this.buffers[0].length) {
            this.shiftBuffer();
        }
        let slice = this.buffers[0].slice(start - this.bufferOffset, end - this.bufferOffset);
        while (end - this.bufferOffset > this.buffers[0].length) {
            this.shiftBuffer();
            slice += this.buffers[0].slice(0, end - this.bufferOffset);
        }
        return slice;
    }
    shiftBuffer() {
        this.bufferOffset += this.buffers[0].length;
        this.writeIndex--;
        this.buffers.shift();
    }
    /**
     * Parses a chunk of data and calls the corresponding callbacks.
     * @param chunk Chunk to parse.
     */
    write(chunk) {
        if (this.ended) {
            this.cbs.onerror?.(new Error(".write() after done!"));
            return;
        }
        this.buffers.push(chunk);
        if (this.tokenizer.running) {
            this.tokenizer.write(chunk);
            this.writeIndex++;
        }
    }
    /**
     * Parses the end of the buffer and clears the stack, calls onend.
     * @param chunk Optional final chunk to parse.
     */
    end(chunk) {
        if (this.ended) {
            this.cbs.onerror?.(new Error(".end() after done!"));
            return;
        }
        if (chunk)
            this.write(chunk);
        this.ended = true;
        this.tokenizer.end();
    }
    /**
     * Pauses parsing. The parser won't emit events until `resume` is called.
     */
    pause() {
        this.tokenizer.pause();
    }
    /**
     * Resumes parsing after `pause` was called.
     */
    resume() {
        this.tokenizer.resume();
        while (this.tokenizer.running &&
            this.writeIndex < this.buffers.length) {
            this.tokenizer.write(this.buffers[this.writeIndex++]);
        }
        if (this.ended)
            this.tokenizer.end();
    }
}
//# sourceMappingURL=Parser.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/htmlparser2/dist/Tokenizer.js"
/*!*******************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/htmlparser2/dist/Tokenizer.js ***!
  \*******************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   QuoteType: () => (/* binding */ QuoteType),
/* harmony export */   "default": () => (/* binding */ Tokenizer)
/* harmony export */ });
/* harmony import */ var entities_decode__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! entities/decode */ "./node_modules/sanitize-html/node_modules/entities/dist/decode.js");
/* harmony import */ var entities_decode__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! entities/decode */ "./node_modules/sanitize-html/node_modules/entities/dist/generated/decode-data-html.js");
/* harmony import */ var entities_decode__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! entities/decode */ "./node_modules/sanitize-html/node_modules/entities/dist/generated/decode-data-xml.js");

var CharCodes;
(function (CharCodes) {
    CharCodes[CharCodes["Tab"] = 9] = "Tab";
    CharCodes[CharCodes["NewLine"] = 10] = "NewLine";
    CharCodes[CharCodes["FormFeed"] = 12] = "FormFeed";
    CharCodes[CharCodes["CarriageReturn"] = 13] = "CarriageReturn";
    CharCodes[CharCodes["Space"] = 32] = "Space";
    CharCodes[CharCodes["ExclamationMark"] = 33] = "ExclamationMark";
    CharCodes[CharCodes["Number"] = 35] = "Number";
    CharCodes[CharCodes["Amp"] = 38] = "Amp";
    CharCodes[CharCodes["SingleQuote"] = 39] = "SingleQuote";
    CharCodes[CharCodes["DoubleQuote"] = 34] = "DoubleQuote";
    CharCodes[CharCodes["Dash"] = 45] = "Dash";
    CharCodes[CharCodes["Slash"] = 47] = "Slash";
    CharCodes[CharCodes["Zero"] = 48] = "Zero";
    CharCodes[CharCodes["Nine"] = 57] = "Nine";
    CharCodes[CharCodes["Semi"] = 59] = "Semi";
    CharCodes[CharCodes["Lt"] = 60] = "Lt";
    CharCodes[CharCodes["Eq"] = 61] = "Eq";
    CharCodes[CharCodes["Gt"] = 62] = "Gt";
    CharCodes[CharCodes["Questionmark"] = 63] = "Questionmark";
    CharCodes[CharCodes["UpperA"] = 65] = "UpperA";
    CharCodes[CharCodes["LowerA"] = 97] = "LowerA";
    CharCodes[CharCodes["UpperF"] = 70] = "UpperF";
    CharCodes[CharCodes["LowerF"] = 102] = "LowerF";
    CharCodes[CharCodes["UpperZ"] = 90] = "UpperZ";
    CharCodes[CharCodes["LowerZ"] = 122] = "LowerZ";
    CharCodes[CharCodes["LowerX"] = 120] = "LowerX";
    CharCodes[CharCodes["OpeningSquareBracket"] = 91] = "OpeningSquareBracket";
})(CharCodes || (CharCodes = {}));
/** All the states the tokenizer can be in. */
var State;
(function (State) {
    State[State["Text"] = 1] = "Text";
    State[State["BeforeTagName"] = 2] = "BeforeTagName";
    State[State["InTagName"] = 3] = "InTagName";
    State[State["InSelfClosingTag"] = 4] = "InSelfClosingTag";
    State[State["BeforeClosingTagName"] = 5] = "BeforeClosingTagName";
    State[State["InClosingTagName"] = 6] = "InClosingTagName";
    State[State["AfterClosingTagName"] = 7] = "AfterClosingTagName";
    // Attributes
    State[State["BeforeAttributeName"] = 8] = "BeforeAttributeName";
    State[State["InAttributeName"] = 9] = "InAttributeName";
    State[State["AfterAttributeName"] = 10] = "AfterAttributeName";
    State[State["BeforeAttributeValue"] = 11] = "BeforeAttributeValue";
    State[State["InAttributeValueDq"] = 12] = "InAttributeValueDq";
    State[State["InAttributeValueSq"] = 13] = "InAttributeValueSq";
    State[State["InAttributeValueNq"] = 14] = "InAttributeValueNq";
    // Declarations
    State[State["BeforeDeclaration"] = 15] = "BeforeDeclaration";
    State[State["InDeclaration"] = 16] = "InDeclaration";
    // Processing instructions
    State[State["InProcessingInstruction"] = 17] = "InProcessingInstruction";
    // Comments & CDATA
    State[State["BeforeComment"] = 18] = "BeforeComment";
    State[State["CDATASequence"] = 19] = "CDATASequence";
    State[State["DeclarationSequence"] = 20] = "DeclarationSequence";
    State[State["InSpecialComment"] = 21] = "InSpecialComment";
    State[State["InCommentLike"] = 22] = "InCommentLike";
    // Special tags
    State[State["SpecialStartSequence"] = 23] = "SpecialStartSequence";
    State[State["InSpecialTag"] = 24] = "InSpecialTag";
    State[State["InPlainText"] = 25] = "InPlainText";
    State[State["InEntity"] = 26] = "InEntity";
})(State || (State = {}));
function isWhitespace(c) {
    return (c === CharCodes.Space ||
        c === CharCodes.NewLine ||
        c === CharCodes.Tab ||
        c === CharCodes.FormFeed ||
        c === CharCodes.CarriageReturn);
}
function isEndOfTagSection(c) {
    return c === CharCodes.Slash || c === CharCodes.Gt || isWhitespace(c);
}
function isASCIIAlpha(c) {
    return ((c >= CharCodes.LowerA && c <= CharCodes.LowerZ) ||
        (c >= CharCodes.UpperA && c <= CharCodes.UpperZ));
}
/**
 * Quote style used for parsed attributes.
 */
var QuoteType;
(function (QuoteType) {
    QuoteType[QuoteType["NoValue"] = 0] = "NoValue";
    QuoteType[QuoteType["Unquoted"] = 1] = "Unquoted";
    QuoteType[QuoteType["Single"] = 2] = "Single";
    QuoteType[QuoteType["Double"] = 3] = "Double";
})(QuoteType || (QuoteType = {}));
/**
 * Sequences used to match longer strings.
 *
 * We don't have `Script`, `Style`, or `Title` here. Instead, we re-use the *End
 * sequences with an increased offset.
 */
const Sequences = {
    Empty: new Uint8Array(0),
    Cdata: new Uint8Array([0x43, 0x44, 0x41, 0x54, 0x41, 0x5b]), // CDATA[
    CdataEnd: new Uint8Array([0x5d, 0x5d, 0x3e]), // ]]>
    CommentEnd: new Uint8Array([0x2d, 0x2d, 0x21, 0x3e]), // `--!>`
    Doctype: new Uint8Array([0x64, 0x6f, 0x63, 0x74, 0x79, 0x70, 0x65]), // `doctype`
    IframeEnd: new Uint8Array([0x3c, 0x2f, 0x69, 0x66, 0x72, 0x61, 0x6d, 0x65]), // `</iframe`
    NoembedEnd: new Uint8Array([
        0x3c, 0x2f, 0x6e, 0x6f, 0x65, 0x6d, 0x62, 0x65, 0x64,
    ]), // `</noembed`
    NoframesEnd: new Uint8Array([
        0x3c, 0x2f, 0x6e, 0x6f, 0x66, 0x72, 0x61, 0x6d, 0x65, 0x73,
    ]), // `</noframes`
    Plaintext: new Uint8Array([
        0x3c, 0x2f, 0x70, 0x6c, 0x61, 0x69, 0x6e, 0x74, 0x65, 0x78, 0x74,
    ]), // `</plaintext`
    ScriptEnd: new Uint8Array([0x3c, 0x2f, 0x73, 0x63, 0x72, 0x69, 0x70, 0x74]), // `</script`
    StyleEnd: new Uint8Array([0x3c, 0x2f, 0x73, 0x74, 0x79, 0x6c, 0x65]), // `</style`
    TitleEnd: new Uint8Array([0x3c, 0x2f, 0x74, 0x69, 0x74, 0x6c, 0x65]), // `</title`
    TextareaEnd: new Uint8Array([
        0x3c, 0x2f, 0x74, 0x65, 0x78, 0x74, 0x61, 0x72, 0x65, 0x61,
    ]), // `</textarea`
    XmpEnd: new Uint8Array([0x3c, 0x2f, 0x78, 0x6d, 0x70]), // `</xmp`
};
/**
 * Maps the first lowercase character of an HTML tag name to the sequence
 * used for special-tag detection.  All sequences share a common layout
 * where index 2 is the first tag-name character, so matching always
 * continues from offset 3.
 */
const specialStartSequences = new Map([
    [Sequences.IframeEnd[2], Sequences.IframeEnd],
    [Sequences.NoembedEnd[2], Sequences.NoembedEnd],
    [Sequences.Plaintext[2], Sequences.Plaintext],
    [Sequences.ScriptEnd[2], Sequences.ScriptEnd],
    [Sequences.TitleEnd[2], Sequences.TitleEnd],
    [Sequences.XmpEnd[2], Sequences.XmpEnd],
]);
/**
 * Tokenizer implementation used by `Parser`.
 */
class Tokenizer {
    cbs;
    /** The current state the tokenizer is in. */
    state = State.Text;
    /** The read buffer. */
    buffer = "";
    /** The beginning of the section that is currently being read. */
    sectionStart = 0;
    /** The index within the buffer that we are currently looking at. */
    index = 0;
    /** The start of the last entity. */
    entityStart = 0;
    /** Some behavior, eg. when decoding entities, is done while we are in another state. This keeps track of the other state type. */
    baseState = State.Text;
    /** For special parsing behavior inside of script and style tags. */
    isSpecial = false;
    /** Indicates whether the tokenizer has been paused. */
    running = true;
    /** The offset of the current buffer. */
    offset = 0;
    xmlMode;
    decodeEntities;
    recognizeSelfClosing;
    entityDecoder;
    constructor({ xmlMode = false, decodeEntities = true, recognizeSelfClosing = xmlMode, }, cbs) {
        this.cbs = cbs;
        this.xmlMode = xmlMode;
        this.decodeEntities = decodeEntities;
        this.recognizeSelfClosing = recognizeSelfClosing;
        this.entityDecoder = new entities_decode__WEBPACK_IMPORTED_MODULE_0__.EntityDecoder(xmlMode ? entities_decode__WEBPACK_IMPORTED_MODULE_2__.xmlDecodeTree : entities_decode__WEBPACK_IMPORTED_MODULE_1__.htmlDecodeTree, (cp, consumed) => this.emitCodePoint(cp, consumed));
    }
    reset() {
        this.state = State.Text;
        this.buffer = "";
        this.sectionStart = 0;
        this.index = 0;
        this.baseState = State.Text;
        this.isSpecial = false;
        this.currentSequence = Sequences.Empty;
        this.sequenceIndex = 0;
        this.running = true;
        this.offset = 0;
    }
    write(chunk) {
        this.offset += this.buffer.length;
        this.buffer = chunk;
        this.parse();
    }
    end() {
        if (this.running)
            this.finish();
    }
    pause() {
        this.running = false;
    }
    resume() {
        this.running = true;
        if (this.index < this.buffer.length + this.offset) {
            this.parse();
        }
    }
    stateText(c) {
        if (c === CharCodes.Lt ||
            (!this.decodeEntities && this.fastForwardTo(CharCodes.Lt))) {
            if (this.index > this.sectionStart) {
                this.cbs.ontext(this.sectionStart, this.index);
            }
            this.state = State.BeforeTagName;
            this.sectionStart = this.index;
        }
        else if (this.decodeEntities && c === CharCodes.Amp) {
            this.startEntity();
        }
    }
    currentSequence = Sequences.Empty;
    sequenceIndex = 0;
    enterTagBody() {
        if (this.currentSequence === Sequences.Plaintext) {
            this.currentSequence = Sequences.Empty;
            this.state = State.InPlainText;
        }
        else if (this.isSpecial) {
            this.state = State.InSpecialTag;
            this.sequenceIndex = 0;
        }
        else {
            this.state = State.Text;
        }
    }
    /**
     * Match the opening tag name against an HTML text-only tag sequence.
     *
     * Some tags share an initial prefix (`script`/`style`, `title`/`textarea`,
     * `noembed`/`noframes`), so we may switch to an alternate sequence at the
     * first distinguishing byte.  On a successful full match we fall back to
     * the normal tag-name state; a later `>` will enter raw-text, RCDATA, or
     * plaintext mode based on `currentSequence` / `isSpecial`.
     * @param c Current character code point.
     */
    stateSpecialStartSequence(c) {
        const lower = c | 0x20;
        // Still matching — check for an alternate sequence at branch points.
        if (this.sequenceIndex < this.currentSequence.length) {
            if (lower === this.currentSequence[this.sequenceIndex]) {
                this.sequenceIndex++;
                return;
            }
            if (this.sequenceIndex === 3) {
                if (this.currentSequence === Sequences.ScriptEnd &&
                    lower === Sequences.StyleEnd[3]) {
                    this.currentSequence = Sequences.StyleEnd;
                    this.sequenceIndex = 4;
                    return;
                }
                if (this.currentSequence === Sequences.TitleEnd &&
                    lower === Sequences.TextareaEnd[3]) {
                    this.currentSequence = Sequences.TextareaEnd;
                    this.sequenceIndex = 4;
                    return;
                }
            }
            else if (this.sequenceIndex === 4 &&
                this.currentSequence === Sequences.NoembedEnd &&
                lower === Sequences.NoframesEnd[4]) {
                this.currentSequence = Sequences.NoframesEnd;
                this.sequenceIndex = 5;
                return;
            }
        }
        else if (isEndOfTagSection(c)) {
            // Full match on a valid tag boundary — keep the sequence.
            this.sequenceIndex = 0;
            this.state = State.InTagName;
            this.stateInTagName(c);
            return;
        }
        // No match — abandon special-tag detection.
        this.isSpecial = false;
        this.currentSequence = Sequences.Empty;
        this.sequenceIndex = 0;
        this.state = State.InTagName;
        this.stateInTagName(c);
    }
    stateCDATASequence(c) {
        if (c === Sequences.Cdata[this.sequenceIndex]) {
            if (++this.sequenceIndex === Sequences.Cdata.length) {
                this.state = State.InCommentLike;
                this.currentSequence = Sequences.CdataEnd;
                this.sequenceIndex = 0;
                this.sectionStart = this.index + 1;
            }
        }
        else {
            this.sequenceIndex = 0;
            if (this.xmlMode) {
                this.state = State.InDeclaration;
                this.stateInDeclaration(c); // Reconsume the character
            }
            else {
                this.state = State.InSpecialComment;
                this.stateInSpecialComment(c); // Reconsume the character
            }
        }
    }
    /**
     * When we wait for one specific character, we can speed things up
     * by skipping through the buffer until we find it.
     * @param c Current character code point.
     * @returns Whether the character was found.
     */
    fastForwardTo(c) {
        while (++this.index < this.buffer.length + this.offset) {
            if (this.buffer.charCodeAt(this.index - this.offset) === c) {
                return true;
            }
        }
        /*
         * We increment the index at the end of the `parse` loop,
         * so set it to `buffer.length - 1` here.
         *
         * TODO: Refactor `parse` to increment index before calling states.
         */
        this.index = this.buffer.length + this.offset - 1;
        return false;
    }
    /**
     * Emit a comment token and return to the text state.
     * @param offset Number of characters in the end sequence that have already been matched.
     */
    emitComment(offset) {
        this.cbs.oncomment(this.sectionStart, this.index, offset);
        this.sequenceIndex = 0;
        this.sectionStart = this.index + 1;
        this.state = State.Text;
    }
    /**
     * Comments and CDATA end with `-->` and `]]>`.
     *
     * Their common qualities are:
     * - Their end sequences have a distinct character they start with.
     * - That character is then repeated, so we have to check multiple repeats.
     * - All characters but the start character of the sequence can be skipped.
     * @param c Current character code point.
     */
    stateInCommentLike(c) {
        if (!this.xmlMode &&
            this.currentSequence === Sequences.CommentEnd &&
            this.sequenceIndex <= 1 &&
            /*
             * We're still at the very start of the comment: the only
             * characters consumed since `<!--` are the dashes that
             * advanced sequenceIndex (0 for `<!-->`, 1 for `<!--->`).
             */
            this.index === this.sectionStart + this.sequenceIndex &&
            c === CharCodes.Gt) {
            // Abruptly closed empty HTML comment.
            this.emitComment(this.sequenceIndex);
        }
        else if (this.currentSequence === Sequences.CommentEnd &&
            this.sequenceIndex === 2 &&
            c === CharCodes.Gt) {
            // `!` is optional here, so the same sequence also accepts `-->`.
            this.emitComment(2);
        }
        else if (this.currentSequence === Sequences.CommentEnd &&
            this.sequenceIndex === this.currentSequence.length - 1 &&
            c !== CharCodes.Gt) {
            this.sequenceIndex = Number(c === CharCodes.Dash);
        }
        else if (c === this.currentSequence[this.sequenceIndex]) {
            if (++this.sequenceIndex === this.currentSequence.length) {
                if (this.currentSequence === Sequences.CdataEnd) {
                    this.cbs.oncdata(this.sectionStart, this.index, 2);
                }
                else {
                    this.cbs.oncomment(this.sectionStart, this.index, 3);
                }
                this.sequenceIndex = 0;
                this.sectionStart = this.index + 1;
                this.state = State.Text;
            }
        }
        else if (this.sequenceIndex === 0) {
            // Fast-forward to the first character of the sequence
            if (this.fastForwardTo(this.currentSequence[0])) {
                this.sequenceIndex = 1;
            }
        }
        else if (c !== this.currentSequence[this.sequenceIndex - 1]) {
            // Allow long sequences, eg. --->, ]]]>
            this.sequenceIndex = 0;
        }
    }
    /**
     * HTML only allows ASCII alpha characters (a-z and A-Z) at the beginning of a tag name.
     *
     * XML allows a lot more characters here (@see https://www.w3.org/TR/REC-xml/#NT-NameStartChar).
     * We allow anything that wouldn't end the tag.
     * @param c Current character code point.
     */
    isTagStartChar(c) {
        return this.xmlMode ? !isEndOfTagSection(c) : isASCIIAlpha(c);
    }
    /**
     * Scan raw-text / RCDATA content for the matching end tag.
     *
     * For RCDATA tags (`<title>`, `<textarea>`) entities are decoded inline.
     * For raw-text tags (`<script>`, `<style>`, etc.) we fast-forward to `<`.
     * @param c Current character code point.
     */
    stateInSpecialTag(c) {
        if (this.sequenceIndex === this.currentSequence.length) {
            if (isEndOfTagSection(c)) {
                const endOfText = this.index - this.currentSequence.length;
                if (this.sectionStart < endOfText) {
                    // Spoof the index so that reported locations match up.
                    const actualIndex = this.index;
                    this.index = endOfText;
                    this.cbs.ontext(this.sectionStart, endOfText);
                    this.index = actualIndex;
                }
                this.isSpecial = false;
                this.sectionStart = endOfText + 2; // Skip over the `</`
                this.stateInClosingTagName(c);
                return; // We are done; skip the rest of the function.
            }
            this.sequenceIndex = 0;
        }
        if ((c | 0x20) === this.currentSequence[this.sequenceIndex]) {
            this.sequenceIndex += 1;
        }
        else if (this.sequenceIndex === 0) {
            if (this.currentSequence === Sequences.TitleEnd ||
                this.currentSequence === Sequences.TextareaEnd) {
                // RCDATA tags have to parse entities while still looking for their end tag.
                if (this.decodeEntities && c === CharCodes.Amp) {
                    this.startEntity();
                }
            }
            else if (this.fastForwardTo(CharCodes.Lt)) {
                // Outside of RCDATA tags, we can fast-forward.
                this.sequenceIndex = 1;
            }
        }
        else {
            // If we see a `<`, set the sequence index to 1; useful for eg. `<</script>`.
            this.sequenceIndex = Number(c === CharCodes.Lt);
        }
    }
    stateBeforeTagName(c) {
        if (c === CharCodes.ExclamationMark) {
            this.state = State.BeforeDeclaration;
            this.sectionStart = this.index + 1;
        }
        else if (c === CharCodes.Questionmark) {
            if (this.xmlMode) {
                this.state = State.InProcessingInstruction;
                this.sequenceIndex = 0;
                this.sectionStart = this.index + 1;
            }
            else {
                this.state = State.InSpecialComment;
                this.sectionStart = this.index;
            }
        }
        else if (this.isTagStartChar(c)) {
            this.sectionStart = this.index;
            const special = this.xmlMode || this.cbs.isInForeignContext?.()
                ? undefined
                : specialStartSequences.get(c | 0x20);
            if (special === undefined) {
                this.state = State.InTagName;
            }
            else {
                this.isSpecial = true;
                this.currentSequence = special;
                this.sequenceIndex = 3;
                this.state = State.SpecialStartSequence;
            }
        }
        else if (c === CharCodes.Slash) {
            this.state = State.BeforeClosingTagName;
        }
        else {
            this.state = State.Text;
            this.stateText(c);
        }
    }
    stateInTagName(c) {
        if (isEndOfTagSection(c)) {
            this.cbs.onopentagname(this.sectionStart, this.index);
            this.sectionStart = -1;
            this.state = State.BeforeAttributeName;
            this.stateBeforeAttributeName(c);
        }
    }
    stateBeforeClosingTagName(c) {
        if (isWhitespace(c)) {
            if (this.xmlMode) {
                // Ignore
            }
            else {
                this.state = State.InSpecialComment;
                this.sectionStart = this.index;
            }
        }
        else if (c === CharCodes.Gt) {
            this.state = State.Text;
            if (!this.xmlMode) {
                this.sectionStart = this.index + 1;
            }
        }
        else {
            this.state = this.isTagStartChar(c)
                ? State.InClosingTagName
                : State.InSpecialComment;
            this.sectionStart = this.index;
        }
    }
    stateInClosingTagName(c) {
        if (isEndOfTagSection(c)) {
            this.cbs.onclosetag(this.sectionStart, this.index);
            this.sectionStart = -1;
            this.state = State.AfterClosingTagName;
            this.stateAfterClosingTagName(c);
        }
    }
    stateAfterClosingTagName(c) {
        // Skip everything until ">"
        if (c === CharCodes.Gt || this.fastForwardTo(CharCodes.Gt)) {
            this.state = State.Text;
            this.sectionStart = this.index + 1;
        }
    }
    stateBeforeAttributeName(c) {
        if (c === CharCodes.Gt) {
            this.cbs.onopentagend(this.index);
            this.enterTagBody();
            this.sectionStart = this.index + 1;
        }
        else if (c === CharCodes.Slash) {
            this.state = State.InSelfClosingTag;
        }
        else if (!isWhitespace(c)) {
            this.state = State.InAttributeName;
            this.sectionStart = this.index;
        }
    }
    /**
     * Handle `/` before `>` in an opening tag.
     *
     * In HTML mode, text-only tags ignore the self-closing flag and still enter
     * their raw-text/RCDATA/plaintext state unless self-closing tags are being
     * recognized. In XML mode, or for ordinary tags, the tokenizer returns to
     * regular text parsing after emitting the self-closing callback.
     * @param c Current character code point.
     */
    stateInSelfClosingTag(c) {
        if (c === CharCodes.Gt) {
            this.cbs.onselfclosingtag(this.index);
            this.sectionStart = this.index + 1;
            if (!this.recognizeSelfClosing) {
                this.enterTagBody();
                return;
            }
            this.state = State.Text;
            this.isSpecial = false; // Reset special state, in case of self-closing special tags
            this.currentSequence = Sequences.Empty;
        }
        else if (!isWhitespace(c)) {
            this.state = State.BeforeAttributeName;
            this.stateBeforeAttributeName(c);
        }
    }
    stateInAttributeName(c) {
        if (c === CharCodes.Eq || isEndOfTagSection(c)) {
            this.cbs.onattribname(this.sectionStart, this.index);
            this.sectionStart = this.index;
            this.state = State.AfterAttributeName;
            this.stateAfterAttributeName(c);
        }
    }
    stateAfterAttributeName(c) {
        if (c === CharCodes.Eq) {
            this.state = State.BeforeAttributeValue;
        }
        else if (c === CharCodes.Slash || c === CharCodes.Gt) {
            this.cbs.onattribend(QuoteType.NoValue, this.sectionStart);
            this.sectionStart = -1;
            this.state = State.BeforeAttributeName;
            this.stateBeforeAttributeName(c);
        }
        else if (!isWhitespace(c)) {
            this.cbs.onattribend(QuoteType.NoValue, this.sectionStart);
            this.state = State.InAttributeName;
            this.sectionStart = this.index;
        }
    }
    stateBeforeAttributeValue(c) {
        if (c === CharCodes.DoubleQuote) {
            this.state = State.InAttributeValueDq;
            this.sectionStart = this.index + 1;
        }
        else if (c === CharCodes.SingleQuote) {
            this.state = State.InAttributeValueSq;
            this.sectionStart = this.index + 1;
        }
        else if (!isWhitespace(c)) {
            this.sectionStart = this.index;
            this.state = State.InAttributeValueNq;
            this.stateInAttributeValueNoQuotes(c); // Reconsume token
        }
    }
    handleInAttributeValue(c, quote) {
        if (c === quote ||
            (!this.decodeEntities && this.fastForwardTo(quote))) {
            this.cbs.onattribdata(this.sectionStart, this.index);
            this.sectionStart = -1;
            this.cbs.onattribend(quote === CharCodes.DoubleQuote
                ? QuoteType.Double
                : QuoteType.Single, this.index + 1);
            this.state = State.BeforeAttributeName;
        }
        else if (this.decodeEntities && c === CharCodes.Amp) {
            this.startEntity();
        }
    }
    stateInAttributeValueDoubleQuotes(c) {
        this.handleInAttributeValue(c, CharCodes.DoubleQuote);
    }
    stateInAttributeValueSingleQuotes(c) {
        this.handleInAttributeValue(c, CharCodes.SingleQuote);
    }
    stateInAttributeValueNoQuotes(c) {
        if (isWhitespace(c) || c === CharCodes.Gt) {
            this.cbs.onattribdata(this.sectionStart, this.index);
            this.sectionStart = -1;
            this.cbs.onattribend(QuoteType.Unquoted, this.index);
            this.state = State.BeforeAttributeName;
            this.stateBeforeAttributeName(c);
        }
        else if (this.decodeEntities && c === CharCodes.Amp) {
            this.startEntity();
        }
    }
    /**
     * Distinguish between CDATA, declarations, HTML comments, and HTML bogus
     * comments after `<!`.
     *
     * In HTML mode, only real comments and doctypes stay on declaration paths;
     * everything else becomes a bogus comment terminated by the next `>`.
     * @param c Current character code point.
     */
    stateBeforeDeclaration(c) {
        if (c === CharCodes.OpeningSquareBracket) {
            this.state = State.CDATASequence;
            this.sequenceIndex = 0;
        }
        else if (this.xmlMode) {
            this.state =
                c === CharCodes.Dash
                    ? State.BeforeComment
                    : State.InDeclaration;
        }
        else if ((c | 0x20) === Sequences.Doctype[0]) {
            this.state = State.DeclarationSequence;
            this.currentSequence = Sequences.Doctype;
            this.sequenceIndex = 1;
        }
        else if (c === CharCodes.Gt) {
            this.cbs.oncomment(this.sectionStart, this.index, 0);
            this.state = State.Text;
            this.sectionStart = this.index + 1;
        }
        else if (c === CharCodes.Dash) {
            this.state = State.BeforeComment;
        }
        else {
            this.state = State.InSpecialComment;
        }
    }
    /**
     * Continue matching `doctype` after `<!d`.
     *
     * A full `doctype` match stays on the declaration path; any other name falls
     * back to an HTML bogus comment, which matches browser behavior for
     * non-doctype `<!...>` constructs.
     * @param c Current character code point.
     */
    stateDeclarationSequence(c) {
        if (this.sequenceIndex === this.currentSequence.length) {
            this.state = State.InDeclaration;
            this.stateInDeclaration(c);
        }
        else if ((c | 0x20) === this.currentSequence[this.sequenceIndex]) {
            this.sequenceIndex += 1;
        }
        else if (c === CharCodes.Gt) {
            this.cbs.oncomment(this.sectionStart, this.index, 0);
            this.state = State.Text;
            this.sectionStart = this.index + 1;
        }
        else {
            this.state = State.InSpecialComment;
        }
    }
    stateInDeclaration(c) {
        if (c === CharCodes.Gt || this.fastForwardTo(CharCodes.Gt)) {
            this.cbs.ondeclaration(this.sectionStart, this.index);
            this.state = State.Text;
            this.sectionStart = this.index + 1;
        }
    }
    /**
     * XML processing instructions (`<?...?>`).
     *
     * In HTML mode `<?` is routed to `InSpecialComment` instead, so this
     * state is only reachable in XML mode.
     * @param c Current character code point.
     */
    stateInProcessingInstruction(c) {
        if (c === CharCodes.Questionmark) {
            // Remember that we just consumed `?`, so the next `>` closes the PI.
            this.sequenceIndex = 1;
        }
        else if (c === CharCodes.Gt && this.sequenceIndex === 1) {
            this.cbs.onprocessinginstruction(this.sectionStart, this.index - 1);
            this.sequenceIndex = 0;
            this.state = State.Text;
            this.sectionStart = this.index + 1;
        }
        else {
            // Keep scanning for the next `?`, which can start a closing `?>`.
            this.sequenceIndex = Number(this.fastForwardTo(CharCodes.Questionmark));
        }
    }
    stateBeforeComment(c) {
        if (c === CharCodes.Dash) {
            this.state = State.InCommentLike;
            this.currentSequence = Sequences.CommentEnd;
            this.sequenceIndex = 0;
            this.sectionStart = this.index + 1;
        }
        else if (this.xmlMode) {
            this.state = State.InDeclaration;
        }
        else if (c === CharCodes.Gt) {
            this.cbs.oncomment(this.sectionStart, this.index, 0);
            this.state = State.Text;
            this.sectionStart = this.index + 1;
        }
        else {
            this.state = State.InSpecialComment;
        }
    }
    stateInSpecialComment(c) {
        if (c === CharCodes.Gt || this.fastForwardTo(CharCodes.Gt)) {
            this.cbs.oncomment(this.sectionStart, this.index, 0);
            this.state = State.Text;
            this.sectionStart = this.index + 1;
        }
    }
    startEntity() {
        this.baseState = this.state;
        this.state = State.InEntity;
        this.entityStart = this.index;
        this.entityDecoder.startEntity(this.xmlMode
            ? entities_decode__WEBPACK_IMPORTED_MODULE_0__.DecodingMode.Strict
            : this.baseState === State.Text ||
                this.baseState === State.InSpecialTag
                ? entities_decode__WEBPACK_IMPORTED_MODULE_0__.DecodingMode.Legacy
                : entities_decode__WEBPACK_IMPORTED_MODULE_0__.DecodingMode.Attribute);
    }
    stateInEntity() {
        const indexInBuffer = this.index - this.offset;
        const length = this.entityDecoder.write(this.buffer, indexInBuffer);
        // If `length` is positive, we are done with the entity.
        if (length >= 0) {
            this.state = this.baseState;
            if (length === 0) {
                this.index -= 1;
            }
        }
        else {
            if (indexInBuffer < this.buffer.length &&
                this.buffer.charCodeAt(indexInBuffer) === CharCodes.Amp) {
                this.state = this.baseState;
                this.index -= 1;
                return;
            }
            // Mark buffer as consumed.
            this.index = this.offset + this.buffer.length - 1;
        }
    }
    /**
     * Remove data that has already been consumed from the buffer.
     */
    cleanup() {
        // If we are inside of text or attributes, emit what we already have.
        if (this.running && this.sectionStart !== this.index) {
            if (this.state === State.Text ||
                this.state === State.InPlainText ||
                (this.state === State.InSpecialTag && this.sequenceIndex === 0)) {
                this.cbs.ontext(this.sectionStart, this.index);
                this.sectionStart = this.index;
            }
            else if (this.state === State.InAttributeValueDq ||
                this.state === State.InAttributeValueSq ||
                this.state === State.InAttributeValueNq) {
                this.cbs.onattribdata(this.sectionStart, this.index);
                this.sectionStart = this.index;
            }
        }
    }
    shouldContinue() {
        return this.index < this.buffer.length + this.offset && this.running;
    }
    /**
     * Iterates through the buffer, calling the function corresponding to the current state.
     *
     * States that are more likely to be hit are higher up, as a performance improvement.
     */
    parse() {
        while (this.shouldContinue()) {
            const c = this.buffer.charCodeAt(this.index - this.offset);
            switch (this.state) {
                case State.Text: {
                    this.stateText(c);
                    break;
                }
                case State.InPlainText: {
                    // Skip to end of buffer; cleanup() emits the text.
                    this.index = this.buffer.length + this.offset - 1;
                    break;
                }
                case State.SpecialStartSequence: {
                    this.stateSpecialStartSequence(c);
                    break;
                }
                case State.InSpecialTag: {
                    this.stateInSpecialTag(c);
                    break;
                }
                case State.CDATASequence: {
                    this.stateCDATASequence(c);
                    break;
                }
                case State.DeclarationSequence: {
                    this.stateDeclarationSequence(c);
                    break;
                }
                case State.InAttributeValueDq: {
                    this.stateInAttributeValueDoubleQuotes(c);
                    break;
                }
                case State.InAttributeName: {
                    this.stateInAttributeName(c);
                    break;
                }
                case State.InCommentLike: {
                    this.stateInCommentLike(c);
                    break;
                }
                case State.InSpecialComment: {
                    this.stateInSpecialComment(c);
                    break;
                }
                case State.BeforeAttributeName: {
                    this.stateBeforeAttributeName(c);
                    break;
                }
                case State.InTagName: {
                    this.stateInTagName(c);
                    break;
                }
                case State.InClosingTagName: {
                    this.stateInClosingTagName(c);
                    break;
                }
                case State.BeforeTagName: {
                    this.stateBeforeTagName(c);
                    break;
                }
                case State.AfterAttributeName: {
                    this.stateAfterAttributeName(c);
                    break;
                }
                case State.InAttributeValueSq: {
                    this.stateInAttributeValueSingleQuotes(c);
                    break;
                }
                case State.BeforeAttributeValue: {
                    this.stateBeforeAttributeValue(c);
                    break;
                }
                case State.BeforeClosingTagName: {
                    this.stateBeforeClosingTagName(c);
                    break;
                }
                case State.AfterClosingTagName: {
                    this.stateAfterClosingTagName(c);
                    break;
                }
                case State.InAttributeValueNq: {
                    this.stateInAttributeValueNoQuotes(c);
                    break;
                }
                case State.InSelfClosingTag: {
                    this.stateInSelfClosingTag(c);
                    break;
                }
                case State.InDeclaration: {
                    this.stateInDeclaration(c);
                    break;
                }
                case State.BeforeDeclaration: {
                    this.stateBeforeDeclaration(c);
                    break;
                }
                case State.BeforeComment: {
                    this.stateBeforeComment(c);
                    break;
                }
                case State.InProcessingInstruction: {
                    this.stateInProcessingInstruction(c);
                    break;
                }
                case State.InEntity: {
                    this.stateInEntity();
                    break;
                }
            }
            this.index++;
        }
        this.cleanup();
    }
    finish() {
        if (this.state === State.InEntity) {
            this.entityDecoder.end();
            this.state = this.baseState;
        }
        this.handleTrailingData();
        this.cbs.onend();
    }
    handleTrailingCommentLikeData(endIndex) {
        if (this.state !== State.InCommentLike) {
            return false;
        }
        if (this.currentSequence === Sequences.CdataEnd) {
            if (this.xmlMode) {
                if (this.sectionStart < endIndex) {
                    this.cbs.oncdata(this.sectionStart, endIndex, 0);
                }
            }
            else {
                /* In HTML mode, unclosed CDATA is a bogus comment. */
                const cdataStart = this.sectionStart - Sequences.Cdata.length - 1;
                this.cbs.oncomment(cdataStart, endIndex, 0);
            }
        }
        else {
            const offset = this.xmlMode
                ? 0
                : Math.min(this.sequenceIndex, Sequences.CommentEnd.length - 1);
            this.cbs.oncomment(this.sectionStart, endIndex, offset);
        }
        return true;
    }
    handleTrailingMarkupDeclaration(endIndex) {
        if (this.xmlMode) {
            switch (this.state) {
                case State.InSpecialComment:
                case State.BeforeComment:
                case State.CDATASequence:
                case State.DeclarationSequence:
                case State.InDeclaration: {
                    this.cbs.ontext(this.sectionStart, endIndex);
                    return true;
                }
                default: {
                    return false;
                }
            }
        }
        switch (this.state) {
            case State.BeforeDeclaration:
            case State.InSpecialComment:
            case State.BeforeComment:
            case State.CDATASequence: {
                this.cbs.oncomment(this.sectionStart, endIndex, 0);
                return true;
            }
            case State.DeclarationSequence: {
                if (this.sequenceIndex !== Sequences.Doctype.length) {
                    this.cbs.oncomment(this.sectionStart, endIndex, 0);
                }
                return true;
            }
            case State.InDeclaration: {
                return true;
            }
            default: {
                return false;
            }
        }
    }
    /** Handle any trailing data. */
    handleTrailingData() {
        const endIndex = this.buffer.length + this.offset;
        if (this.handleTrailingCommentLikeData(endIndex) ||
            this.handleTrailingMarkupDeclaration(endIndex)) {
            return;
        }
        // If there is no remaining data, we are done.
        if (this.sectionStart >= endIndex) {
            return;
        }
        switch (this.state) {
            case State.InTagName:
            case State.BeforeAttributeName:
            case State.BeforeAttributeValue:
            case State.AfterAttributeName:
            case State.InAttributeName:
            case State.InAttributeValueSq:
            case State.InAttributeValueDq:
            case State.InAttributeValueNq:
            case State.InClosingTagName: {
                /*
                 * If we are currently in an opening or closing tag, us not calling the
                 * respective callback signals that the tag should be ignored.
                 */
                break;
            }
            default: {
                this.cbs.ontext(this.sectionStart, endIndex);
            }
        }
    }
    emitCodePoint(cp, consumed) {
        if (this.baseState !== State.Text &&
            this.baseState !== State.InSpecialTag) {
            if (this.sectionStart < this.entityStart) {
                this.cbs.onattribdata(this.sectionStart, this.entityStart);
            }
            this.sectionStart = this.entityStart + consumed;
            this.index = this.sectionStart - 1;
            this.cbs.onattribentity(cp);
        }
        else {
            if (this.sectionStart < this.entityStart) {
                this.cbs.ontext(this.sectionStart, this.entityStart);
            }
            this.sectionStart = this.entityStart + consumed;
            this.index = this.sectionStart - 1;
            this.cbs.ontextentity(cp, this.sectionStart);
        }
    }
}
//# sourceMappingURL=Tokenizer.js.map

/***/ },

/***/ "./node_modules/sanitize-html/node_modules/htmlparser2/dist/index.js"
/*!***************************************************************************!*\
  !*** ./node_modules/sanitize-html/node_modules/htmlparser2/dist/index.js ***!
  \***************************************************************************/
(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   DefaultHandler: () => (/* reexport safe */ domhandler__WEBPACK_IMPORTED_MODULE_1__.DomHandler),
/* harmony export */   DomHandler: () => (/* reexport safe */ domhandler__WEBPACK_IMPORTED_MODULE_1__.DomHandler),
/* harmony export */   DomUtils: () => (/* reexport module object */ domutils__WEBPACK_IMPORTED_MODULE_5__),
/* harmony export */   ElementType: () => (/* reexport module object */ domelementtype__WEBPACK_IMPORTED_MODULE_2__),
/* harmony export */   Parser: () => (/* reexport safe */ _Parser_js__WEBPACK_IMPORTED_MODULE_0__.Parser),
/* harmony export */   QuoteType: () => (/* reexport safe */ _Tokenizer_js__WEBPACK_IMPORTED_MODULE_3__.QuoteType),
/* harmony export */   Tokenizer: () => (/* reexport safe */ _Tokenizer_js__WEBPACK_IMPORTED_MODULE_3__["default"]),
/* harmony export */   createDocumentStream: () => (/* binding */ createDocumentStream),
/* harmony export */   getFeed: () => (/* reexport safe */ domutils__WEBPACK_IMPORTED_MODULE_4__.getFeed),
/* harmony export */   parseDocument: () => (/* binding */ parseDocument),
/* harmony export */   parseFeed: () => (/* binding */ parseFeed)
/* harmony export */ });
/* harmony import */ var _Parser_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Parser.js */ "./node_modules/sanitize-html/node_modules/htmlparser2/dist/Parser.js");
/* harmony import */ var domhandler__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! domhandler */ "./node_modules/sanitize-html/node_modules/domhandler/dist/index.js");
/* harmony import */ var domelementtype__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! domelementtype */ "./node_modules/sanitize-html/node_modules/domelementtype/dist/index.js");
/* harmony import */ var _Tokenizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Tokenizer.js */ "./node_modules/sanitize-html/node_modules/htmlparser2/dist/Tokenizer.js");
/* harmony import */ var domutils__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! domutils */ "./node_modules/sanitize-html/node_modules/domutils/dist/feeds.js");
/* harmony import */ var domutils__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! domutils */ "./node_modules/sanitize-html/node_modules/domutils/dist/index.js");




// Helper methods
/**
 * Parses the data, returns the resulting document.
 * @param data The data that should be parsed.
 * @param options Optional options for the parser and DOM handler.
 */
function parseDocument(data, options) {
    const handler = new domhandler__WEBPACK_IMPORTED_MODULE_1__.DomHandler(undefined, options);
    new _Parser_js__WEBPACK_IMPORTED_MODULE_0__.Parser(handler, options).end(data);
    return handler.root;
}
/**
 * Creates a parser instance, with an attached DOM handler.
 * @param callback A callback that will be called once parsing has been completed, with the resulting document.
 * @param options Optional options for the parser and DOM handler.
 * @param elementCallback An optional callback that will be called every time a tag has been completed inside of the DOM.
 */
function createDocumentStream(callback, options, elementCallback) {
    const handler = new domhandler__WEBPACK_IMPORTED_MODULE_1__.DomHandler((error) => callback(error, handler.root), options, elementCallback);
    return new _Parser_js__WEBPACK_IMPORTED_MODULE_0__.Parser(handler, options);
}
/*
 * All of the following exports exist for backwards-compatibility.
 * They should probably be removed eventually.
 */


;

const parseFeedDefaultOptions = { xmlMode: true };
/**
 * Parse a feed.
 * @param feed The feed that should be parsed, as a string.
 * @param options Optionally, options for parsing. When using this, you should set `xmlMode` to `true`.
 */
function parseFeed(feed, options = parseFeedDefaultOptions) {
    return (0,domutils__WEBPACK_IMPORTED_MODULE_4__.getFeed)(parseDocument(feed, options).children);
}

//# sourceMappingURL=index.js.map

/***/ }

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	const __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		const cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		const module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		if (!(moduleId in __webpack_modules__)) {
/******/ 			delete __webpack_module_cache__[moduleId];
/******/ 			const e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
/******/ 		}
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = (module) => {
/******/ 		const getter = module && module.__esModule ?
/******/ 			() => (module['default']) :
/******/ 			() => (module);
/******/ 		__webpack_require__.d(getter, { a: getter });
/******/ 		return getter;
/******/ 	};
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	// define getter/value functions for harmony exports
/******/ 	__webpack_require__.d = (exports, definition) => {
/******/ 		for(var key in definition) {
/******/ 			if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 				Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 			}
/******/ 		}
/******/ 	};
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	__webpack_require__.g = (function() {
/******/ 		if (typeof globalThis === 'object') return globalThis;
/******/ 		try {
/******/ 			return this || new Function('return this')();
/******/ 		} catch (e) {
/******/ 			if (typeof window === 'object') return window;
/******/ 		}
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop));
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = (exports) => {
/******/ 		Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/ 	
/************************************************************************/
let __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
(() => {
"use strict";
/*!************************************************************!*\
  !*** ./platform/packages/menu/resources/assets/js/menu.js ***!
  \************************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var sanitize_html__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! sanitize-html */ "./node_modules/sanitize-html/index.js");
/* harmony import */ var sanitize_html__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(sanitize_html__WEBPACK_IMPORTED_MODULE_0__);
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
;
var MenuNestable = /*#__PURE__*/function () {
  function MenuNestable() {
    _classCallCheck(this, MenuNestable);
    this.$nestable = $('#nestable');
  }
  return _createClass(MenuNestable, [{
    key: "setDataItem",
    value: function setDataItem(target) {
      target.each(function (index, el) {
        var current = $(el);
        current.data('id', current.attr('data-id'));
        current.data('title', current.attr('data-title'));
        current.data('reference-id', current.attr('data-reference-id'));
        current.data('reference-type', current.attr('data-reference-type'));
        current.data('custom-url', current.attr('data-custom-url'));
        current.data('class', current.attr('data-class'));
        current.data('target', current.attr('data-target'));
      });
    }
  }, {
    key: "updatePositionForSerializedObj",
    value: function updatePositionForSerializedObj(arrayObject) {
      var result = arrayObject;
      var that = this;
      $.each(result, function (index, val) {
        val.position = index;
        if (typeof val.children == 'undefined') {
          val.children = [];
        }
        that.updatePositionForSerializedObj(val.children);
      });
      return result;
    }

    // Main function to initiate the module
  }, {
    key: "init",
    value: function init() {
      var depth = parseInt(this.$nestable.attr('data-depth'));
      if (depth < 1) {
        depth = 5;
      }
      $('.nestable-menu').nestable({
        group: 1,
        maxDepth: depth,
        expandBtnHTML: '',
        collapseBtnHTML: ''
      });
      this.handleNestableMenu();
    }
  }, {
    key: "handleNestableMenu",
    value: function handleNestableMenu() {
      var that = this;
      // Show node details
      $(document).on('click', '.dd-item .dd3-content a.show-item-details', function (event) {
        event.preventDefault();
        var parent = $(event.currentTarget).parent().parent();
        $(event.currentTarget).toggleClass('active');
        parent.toggleClass('active');
      });

      // Edit attributes
      $(document).on('change blur keyup', '.nestable-menu .item-details input[type="text"], .nestable-menu .item-details select', function (event) {
        event.preventDefault();
        var current = $(event.currentTarget);
        var parent = current.closest('li.dd-item');
        var value = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()(current.val());
        var name = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()(current.attr('name'));
        var old = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()(current.attr('data-old'));
        parent.attr('data-' + name, value);
        parent.data(name, value);
        parent.find('> .dd3-content .text[data-update="' + name + '"]').text(value);
        if (value.trim() === '') {
          parent.find('> .dd3-content .text[data-update="' + name + '"]').text(old);
        }
        that.setDataItem(that.$nestable.find('> ol.dd-list li.dd-item'));
      });

      // Add nodes
      $(document).on('click', '.box-links-for-menu .btn-add-to-menu', function (event) {
        event.preventDefault();
        var current = $(event.currentTarget);
        var parent = current.parents('.the-box');
        var html = '';
        if (parent.attr('id') === 'external_link') {
          var data_type = 'custom-link';
          var data_reference_id = 0;
          var data_title = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()($('#node-title').val());
          var data_url = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()($('#node-url').val());
          var data_css_class = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()($('#node-css').val());
          var data_font_icon = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()($('#node-icon').val());
          var data_target = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()($('#target').find('option:selected').val());
          var url_html = '<label class="pad-bot-5"><span class="text pad-top-5 dis-inline-block" data-update="custom-url">Url</span><input type="text" data-old="' + data_url + '" value="' + data_url + '" name="custom-url"></label>';
          html += '<li data-reference-type="' + data_type + '" data-reference-id="' + data_reference_id + '" data-title="' + data_title + '" data-class="' + data_css_class + '" data-id="0" data-custom-url="' + data_url + '" data-icon-font="' + data_font_icon + '" data-target="' + data_target + '" class="dd-item dd3-item">';
          html += '<div class="dd-handle dd3-handle"></div>';
          html += '<div class="dd3-content">';
          html += '<span class="text float-left" data-update="title">' + data_title + '</span>';
          html += '<span class="text float-right">' + data_type + '</span>';
          html += '<a href="#" class="show-item-details"><i class="fa fa-angle-down"></i></a>';
          html += '<div class="clearfix"></div>';
          html += '</div>';
          html += '<div class="item-details">';
          html += '<label class="pad-bot-5">';
          html += '<span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>';
          html += '<input type="text" data-old="' + data_title + '" value="' + data_title + '" name="title" class="form-control">';
          html += '</label>';
          html += url_html;
          html += '<label class="pad-bot-5 dis-inline-block"><span class="text pad-top-5" data-update="icon-font">Icon - font</span><input type="text" name="icon-font" value="' + data_font_icon + '" data-old="' + data_font_icon + '" class="form-control"></label>';
          html += '<label class="pad-bot-10">';
          html += '<span class="text pad-top-5 dis-inline-block" data-update="class">CSS class</span>';
          html += '<input type="text" data-old="' + data_css_class + '" value="' + data_css_class + '" name="class" class="form-control">';
          html += '</label>';
          html += '<label class="pad-bot-10">';
          html += '<span class="text pad-top-5 dis-inline-block" data-update="target">Target</span>';
          html += '<div style="width: 228px; display: inline-block"><select name="target" id="target" data-old="' + data_target + '" class="form-control select-full">';
          html += '<option value="_self">Open link directly</option>';
          html += '<option value="_blank" ' + (data_target === '_blank' ? 'selected="selected"' : '') + '>Open link in new tab</option>';
          html += '</select></div>';
          html += '</label>';
          html += '<div class="text-right">';
          html += '<a class="btn red btn-remove" href="#">Remove</a>';
          html += '<a class="btn blue btn-cancel" href="#">Cancel</a>';
          html += '</div>';
          html += '</div>';
          html += '<div class="clearfix"></div>';
          html += '</li>';
          parent.find('input[type="text"]').val('');
        } else {
          parent.find('.list-item li.active').each(function (index, el) {
            var find_in = $(el).find('> label');
            var data_type = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()(find_in.attr('data-reference-type'));
            var data_reference_id = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()(find_in.attr('data-reference-id'));
            var data_title = sanitize_html__WEBPACK_IMPORTED_MODULE_0___default()(find_in.attr('data-title'));
            html += '<li data-reference-type="' + data_type + '" data-reference-id="' + data_reference_id + '" data-title="' + data_title + '" data-id="0" data-target="_self" class="dd-item dd3-item">';
            html += '<div class="dd-handle dd3-handle"></div>';
            html += '<div class="dd3-content">';
            html += '<span class="text float-left" data-update="title">' + data_title + '</span>';
            html += '<span class="text float-right">' + data_type + '</span>';
            html += '<a href="#" class="show-item-details"><i class="fa fa-angle-down"></i></a>';
            html += '<div class="clearfix"></div>';
            html += '</div>';
            html += '<div class="item-details">';
            html += '<label class="pad-bot-5">';
            html += '<span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>';
            html += '<input type="text" data-old="' + data_title + '" value="' + data_title + '" name="title" class="form-control">';
            html += '</label>';
            html += '<label class="pad-bot-5 dis-inline-block"><span class="text pad-top-5" data-update="icon-font">Icon - font</span><input type="text" name="icon-font" class="form-control"></label>';
            html += '<label class="pad-bot-10">';
            html += '<span class="text pad-top-5 dis-inline-block" data-update="class">CSS class</span>';
            html += '<input type="text" name="class" class="form-control">';
            html += '</label>';
            html += '<label class="pad-bot-10">';
            html += '<span class="text pad-top-5 dis-inline-block" data-update="target">Target</span>';
            html += '<div style="width: 228px; display: inline-block"><select name="target" id="target" class="form-control select-full">';
            html += '<option value="_self">Open link directly</option>';
            html += '<option value="_blank">Open link in new tab</option>';
            html += '</select></div>';
            html += '</label>';
            html += '<div class="text-right">';
            html += '<a class="btn red btn-remove" href="#">Remove</a>';
            html += '<a class="btn blue btn-cancel" href="#">Cancel</a>';
            html += '</div>';
            html += '</div>';
            html += '<div class="clearfix"></div>';
            html += '</li>';
            $(el).find('input[type=checkbox]').prop('checked', false);
          });
        }
        $('.nestable-menu > ol.dd-list').append(html.replace('<script>', '').replace('<\\/script>', ''));
        $('.nestable-menu').find('.select-full').select2({
          width: '100%',
          minimumResultsForSearch: -1
        });

        // Change json
        that.setDataItem(that.$nestable.find('> ol.dd-list li.dd-item'));
        parent.find('.list-item li.active').removeClass('active');
      });

      // Remove nodes
      $('.form-save-menu input[name="deleted_nodes"]').val('');
      $(document).on('click', '.nestable-menu .item-details .btn-remove', function (event) {
        event.preventDefault();
        var current = $(event.currentTarget);
        var dd_item = current.parents('.item-details').parent();
        var $elm = $('.form-save-menu input[name="deleted_nodes"]');
        // Add id of deleted nodes to delete in controller
        $elm.val($elm.val() + ' ' + dd_item.attr('data-id'));
        var children = dd_item.find('> .dd-list').html();
        if (children !== '' && children != null) {
          dd_item.before(children.replace('<script>', '').replace('<\\/script>', ''));
        }
        dd_item.remove();
      });
      $(document).on('click', '.nestable-menu .item-details .btn-cancel', function (event) {
        event.preventDefault();
        var current_pa = $(event.currentTarget);
        var parent = current_pa.parents('.item-details').parent();
        parent.find('input[type="text"]').each(function (index, el) {
          $(el).val($(el).attr('data-old'));
        });
        parent.find('select').each(function (index, el) {
          $(el).val($(el).val());
        });
        parent.find('input[type="text"]').trigger('change');
        parent.find('select').trigger('change');
        parent.removeClass('active');
      });
      $(document).on('change', '.box-links-for-menu .list-item li input[type=checkbox]', function (event) {
        $(event.currentTarget).closest('li').toggleClass('active');
      });
      $(document).on('submit', '.form-save-menu', function () {
        if (that.$nestable.length < 1) {
          $('#nestable-output').val('[]');
        } else {
          var nestable_obj_returned = that.$nestable.nestable('serialize');
          var the_obj = that.updatePositionForSerializedObj(nestable_obj_returned);
          $('#nestable-output').val(JSON.stringify(the_obj));
        }
      });
      var accordion = $('#accordion');
      var toggleChevron = function toggleChevron(event) {
        $(event.target).prev('.widget-heading').find('.narrow-icon').toggleClass('fa-angle-down fa-angle-up');
      };
      accordion.on('hidden.bs.collapse', toggleChevron);
      accordion.on('shown.bs.collapse', toggleChevron);
      Cms.callScroll($('.list-item'));
    }
  }]);
}();
$(window).on('load', function () {
  new MenuNestable().init();
});
})();

/******/ })()
;