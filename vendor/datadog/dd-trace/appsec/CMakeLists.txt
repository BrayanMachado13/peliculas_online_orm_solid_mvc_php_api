cmake_minimum_required(VERSION 3.14)


list(APPEND CMAKE_MODULE_PATH "${CMAKE_CURRENT_LIST_DIR}/../cmake/Modules")

option(HUNTER_STATUS_DEBUG "Print Hunter debug info" OFF)

include("cmake/HunterGate.cmake")
HunterGate(
    URL "https://github.com/cpp-pm/hunter/archive/v0.25.3.tar.gz"
    SHA1 "0dfbc2cb5c4cf7e83533733bdfd2125ff96680cb")

configure_file(${CMAKE_CURRENT_SOURCE_DIR}/hunter-cache.id.in ${CMAKE_CURRENT_SOURCE_DIR}/hunter-cache.id)

project(ddappsec VERSION 0.98.0)

include(CheckCXXCompilerFlag)

set(CMAKE_EXPORT_COMPILE_COMMANDS ON)
set(CMAKE_C_STANDARD 11)
set(CMAKE_C_STANDARD_REQUIRED ON)
set(CMAKE_CXX_STANDARD 17)
set(CMAKE_CXX_STANDARD_REQUIRED ON)

cmake_policy(SET CMP0083 NEW) # make PIE executables when PIC property is set

option(DD_APPSEC_BUILD_HELPER "Whether to builder the helper" ON)
option(DD_APPSEC_BUILD_EXTENSION "Whether to builder the extension" ON)
option(DD_APPSEC_ENABLE_COVERAGE "Whether to enable coverage calculation" OFF)
option(DD_APPSEC_TESTING "Whether to enable testing" ON)
option(DD_APPSEC_DDTRACE_ALT "Whether to build appsec with cmake" OFF)

add_subdirectory(third_party EXCLUDE_FROM_ALL)

include("cmake/patchelf.cmake")

if (DD_APPSEC_BUILD_EXTENSION)
    include("cmake/extension.cmake")
endif()

if (DD_APPSEC_BUILD_HELPER)
    include ("cmake/helper.cmake")
endif()

include(cmake/clang-tidy.cmake)
include(cmake/clang-format.cmake)

# When you enable this option. The file cmake/local.cmake will be included as part of the build.
# The file cmake/local.cmake is ignored by git. Feel free to add anything you need to support
# your local build. One example this is used for is to tell Clion where to find PHP Sources
option(DD_APPSEC_LOCAL_CONFIGURATIONS "Whether to include the local.cmake file content as part of the build process" OFF)
if(DD_APPSEC_LOCAL_CONFIGURATIONS)
    include(cmake/local.cmake)
endif()
